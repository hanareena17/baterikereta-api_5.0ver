<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function deleteAccount(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $user = $request->user();
            
            Log::info('Starting account deletion for user: ' . $user->id);
            
            // Delete points first
            if ($user->points) {
                Log::info('Deleting user points');
                $user->points->delete();
            }
            
            // Delete profile
            if ($user->profile) {
                Log::info('Deleting user profile');
                $user->profile->delete();
            }
            
            // Delete cars
            if ($user->cars()->exists()) {
                Log::info('Deleting user cars');
                $user->cars()->delete();
            }
            
            // Delete payments
            if ($user->payments()->exists()) {
                Log::info('Deleting user payments');
                $user->payments()->delete();
            }
            
            // Delete service history
            if ($user->serviceHistory()->exists()) {
                Log::info('Deleting user service history');
                $user->serviceHistory()->delete();
            }
            
            // Delete tokens
            if ($user->tokens()->exists()) {
                Log::info('Deleting user tokens');
                $user->tokens()->delete();
            }
            
            // Finally, delete the user
            Log::info('Deleting user account');
            $user->delete();
            
            DB::commit();
            Log::info('Account deletion completed successfully');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Account deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Account deletion failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete account',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
} 