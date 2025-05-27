<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                \Log::error('No authenticated user found');
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            $profile = $user->profile;
            \Log::info('User profile data:', [
                'user_id' => $user->id,
                'has_profile' => !is_null($profile),
                'profile_image' => $profile ? $profile->profile_image : null
            ]);

            // Add full URL to profile image if it exists
            if ($profile && $profile->profile_image) {
                $profile->profile_image = url($profile->profile_image);
            }

            return response()->json([
                'data' => [
                    'profile' => $profile,
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'ic' => $user->ic                 
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in show profile: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching profile'], 500);
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female',
            'dob' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ic' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20'
        ]);

        try {
            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile_images'), $imageName);
                $validated['profile_image'] = 'profile_images/' . $imageName;
            }

            // Update user's phone and IC
            if (isset($validated['phone'])) {
                $user->phone = $validated['phone'];
                unset($validated['phone']);
            }
            // This part is correct - it puts the IC in the user model
            if (isset($validated['ic'])) {
                $user->ic = $validated['ic'];
                unset($validated['ic']);// this should remove ic from $validated
            }
            $user->save();

            // But then it passes the $validated array to update the profile
            // Update or create profile
            if ($user->profile) {
                $user->profile->update($validated);
            } else {
                $validated['user_id'] = $user->id;
                UserProfile::create($validated);
            }

            // Add full URL to profile image in response
            if ($user->profile && $user->profile->profile_image) {
                $user->profile->profile_image = url($user->profile->profile_image);
            }

            return response()->json([
                'message' => 'Profile updated successfully',
                'data' => [
                    'user' => $user,
                    'profile' => $user->profile
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteProfileImage(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $profile = $user->profile;

        if ($profile && $profile->profile_image) {
            // Optionally, delete the actual file from storage
            // For example, if stored in public/profile_images:
            // $imagePath = public_path($profile->profile_image);
            // if (file_exists($imagePath)) {
            //     unlink($imagePath);
            // }

            $profile->profile_image = null;
            $profile->save();

            return response()->json(['message' => 'Profile image deleted successfully.']);
        }

        return response()->json(['message' => 'No profile image to delete.'], 404);
    }
}