<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\SignupStoreRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\UserPoint;

class AuthController extends Controller
{
    use HttpResponses;

    public function loginView()
    {
        return view('auth.login');
    }

    /**
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $request->validated($request->all());

        if(!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('', 'Invalid login credentials!', 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of: ' . $user->name)->plainTextToken
        ], 'Login successful!');
    }

    public function activeUser(Request $request): JsonResponse
    {
        if(!$request->user())
            return $this->error([], 'User is not authenticated!', 401);
        else
            return $this->success($request->user(), 'User is authenticated!');
    }

    /**
     * Check if the user is authenticated.
     */
    public function check(): JsonResponse
    {
        if(Auth::check())
            return $this->success([], 'User is authenticated!');
        else
            return $this->error([], 'User is not authenticated!', 401);
    }


    /**
     * @param SignupStoreRequest $request
     * @return JsonResponse
     */
    public function register(SignupStoreRequest $request): JsonResponse
    {
        $request->validated($request->all());

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Create user profile with initial information
        $user->profile()->create([
            'user_id' => $user->id,
            'address' => null,
            'city' => null,
            'postcode' => null,
            'state' => null,
            'profile_image' => null,
            'gender' => null,
            'dob' => null
        ]);
        // Send OTP email
        try {
            Mail::send('emails.otp', ['otp' => $otp, 'name' => $user->name], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your OTP Verification Code');
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            return $this->error([], 'Failed to send OTP email. Please try again.', 500);
        }

        $token = $user->createToken('API Token')->plainTextToken; 

        \Log::info('Sending user_id to frontend for OTP verification:', ['user_id' => $user->id]);

        return response()->json([
            'message' => 'Registration successful, please verify OTP',
            'data' => [
                'user_id' => $user->id,
                'token' => $token
            ]
        ], 201);


        
        // UserPoint::create([
        //     'id' => Str::uuid(),
        //     'user_id' => $user->id,
        //     'points' => 0,
        // ]);


    }
    
    public function verifyOtp(Request $request): JsonResponse
    {
        \Log::info('Received OTP verification request:', [
            'user_id' => $request->user_id,
            'otp' => $request->otp,
            'otp_type' => gettype($request->otp),
            'otp_length' => strlen($request->otp)
        ]);

        $request->validate([
            // 'user_id' => 'required|uuid|exists:users,id',
            'user_id' => 'required|string|exists:users,id',
            'otp' => 'required|string|size:6',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            \Log::warning('User not found for ID: ' . $request->user_id);
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        \Log::info('Found user:', [
            'user_id' => $user->id,
            'stored_otp' => $user->otp,
            'stored_otp_type' => gettype($user->otp),
            'received_otp' => $request->otp,
            'received_otp_type' => gettype($request->otp)
        ]);

        // Convert both OTPs to strings for comparison
        $storedOtp = (string)$user->otp;
        $receivedOtp = (string)$request->otp;

        if ($storedOtp !== $receivedOtp) {
            \Log::warning('OTP mismatch:', [
                'stored_otp' => $storedOtp,
                'received_otp' => $receivedOtp,
                'stored_otp_type' => gettype($storedOtp),
                'received_otp_type' => gettype($receivedOtp)
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 422);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            \Log::warning('OTP expired:', [
                'expires_at' => $user->otp_expires_at,
                'current_time' => now()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired'
            ], 422);
        }

        // Mark user as verified
        $user->two_fa_enabled = true;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        \Log::info('OTP verified successfully for user:', ['user_id' => $user->id]);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

    public function resendOtp(Request $request): JsonResponse
    {
        $request->validate([
            // 'email' => 'required|email|exists:users,email',
            'user_id' => 'required|string|exists:users,id',
        ]);
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
        
        $otp = rand(100000, 999999);
    
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        try {
            Mail::send('emails.otp', ['otp' => $otp, 'name' => $user->name], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your OTP Verification Code');
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            return $this->error([], 'Failed to send OTP email. Please try again.', 500);
        }
        
        return $this->success([
            'message' => 'OTP has been resent'
        ]);
    }
    //     $user = User::where('email', $request->email)->first();
    //     $otp = rand(100000, 999999);
    
    //     $user->otp = $otp;
    //     $user->otp_expires_at = now()->addMinutes(5);
    //     $user->save();
    
    //     return $this->success([
    //         'message' => 'OTP has been resent',
    //         'otp' => $otp
    //     ]);
    // }

    public function sendResetLink(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['message' => 'Email not found'], 404);
            }

            $token = Str::random(60);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                [
                    'id' => (string) Str::uuid(),
                    'token' => $token, 
                    'created_at' => Carbon::now()
                    ]
            );

            // Send email using Blade template
            Mail::send('emails.forgot-password', ['token' => $token], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Password Reset Request');
            });

            return response()->json(['message' => 'Reset link sent to your email.']);
        } catch (\Exception $e) {
            \Log::error('Password reset error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send reset link. Please try again.'], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'token' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);

            $reset = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if (!$reset) {
                return response()->json(['message' => 'Invalid or expired token'], 400);
            }

            // Check if token is expired (60 minutes)
            if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
                DB::table('password_reset_tokens')->where('email', $request->email)->delete();
                return response()->json(['message' => 'Token has expired'], 400);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the used token
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return response()->json(['message' => 'Password successfully updated.']);
        } catch (\Exception $e) {
            \Log::error('Password reset error: ' . $e->getMessage());
            return response()->json(['message' => 'Error resetting password'], 500);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        if($request->user()->currentAccessToken()->delete())
            return $this->success([], 'Logout successful!, Your token has been destroyed!');
        else
            return $this->error([], 'Logout failed!, Your token has not been destroyed!', 401);
    }

    public function verifyResetToken($token)
    {
        try {
            \Log::info('Verifying reset token: ' . $token);
            
            $reset = DB::table('password_reset_tokens')
                ->where('token', $token)
                ->first();

            if (!$reset) {
                \Log::warning('Invalid token provided: ' . $token);
                return response()->json(['message' => 'Invalid token'], 400);
            }

            if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
                \Log::warning('Expired token: ' . $token);
                DB::table('password_reset_tokens')->where('token', $token)->delete();
                return response()->json(['message' => 'Token has expired'], 400);
            }

            \Log::info('Token verified successfully for email: ' . $reset->email);
            return response()->json(['email' => $reset->email]);
        } catch (\Exception $e) {
            \Log::error('Token verification error: ' . $e->getMessage());
            return response()->json(['message' => 'Error verifying token'], 500);
        }
    }
}
