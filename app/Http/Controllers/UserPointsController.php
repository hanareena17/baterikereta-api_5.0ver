<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPoint;
use App\Models\RewardItem; // Added
use App\Models\PointRedemption; // Added
use Illuminate\Support\Facades\DB; // Added for potential transaction
use Carbon\Carbon; // Added for date comparison

class UserPointsController extends Controller
{
    /**
     * Get the authenticated user's points.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Ensure user_points record exists, create if not
        $userPoints = UserPoint::firstOrCreate(
            ['user_id' => $user->id],
            ['points' => 0] // Default points if new record
        );

        return response()->json(['points' => $userPoints->points]);
    }

    /**
     * Add points for a user.
     * This is a conceptual example. You'll need to integrate this
     * with your order completion logic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPoints(Request $request)
    {
        $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'amount_spent' => 'required|numeric|min:0',
        ]);

        $user = \App\Models\User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $pointsToAdd = floor($request->amount_spent); // 1 point per RM1

        if ($pointsToAdd > 0) {
            $userPoints = UserPoint::firstOrCreate(
                ['user_id' => $user->id],
                ['points' => 0]
            );
            $userPoints->points += $pointsToAdd;
            $userPoints->save();
        }
        
        return response()->json(['message' => 'Points added successfully.', 'new_points_balance' => $userPoints->points ?? 0]);
    }

    /**
     * Redeem points for a reward.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function redeem(Request $request)
    {
        $request->validate([
            'reward_item_id' => 'required|uuid|exists:reward_items,id',
        ]);

        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $rewardItem = RewardItem::find($request->reward_item_id);

        if (!$rewardItem) {
            // This should ideally be caught by 'exists' validation, but as a fallback
            return response()->json(['message' => 'Reward item not found.'], 404);
        }

        if (!$rewardItem->is_active) {
            return response()->json(['message' => 'This reward is currently not active.'], 400);
        }

        // Check quantity if applicable
        if (!is_null($rewardItem->quantity) && $rewardItem->quantity <= 0) {
            return response()->json(['message' => 'This reward is out of stock.'], 400);
        }
        
        // Check validity period
        $now = now();
        if (
            ($rewardItem->valid_from && $now->lt(Carbon::parse($rewardItem->valid_from))) ||
            ($rewardItem->valid_until && $now->gt(Carbon::parse($rewardItem->valid_until)))
        ) {
            return response()->json(['message' => 'This reward is not available at this time.'], 400);
        }

        $userPoints = UserPoint::firstOrCreate(
            ['user_id' => $user->id],
            ['points' => 0]
        );

        if ($userPoints->points < $rewardItem->points_cost) {
            return response()->json(['message' => 'Insufficient points.'], 400);
        }

        try {
            DB::beginTransaction();

            // Deduct points
            $userPoints->points -= $rewardItem->points_cost;
            $userPoints->save();

            // Decrement quantity if applicable
            if (!is_null($rewardItem->quantity)) {
                $rewardItem->quantity -= 1;
                $rewardItem->save();
            }

            // Log the redemption
            PointRedemption::create([
                'user_id' => $user->id,
                'reward_item_id' => $rewardItem->id,
                'points_used' => $rewardItem->points_cost,
                'status' => 'completed', // Or 'pending' if further processing is needed
                'redeemed_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Reward redeemed successfully: ' . $rewardItem->name,
                'new_points_balance' => $userPoints->points
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Redemption failed: ' . $e->getMessage());
            return response()->json(['message' => 'Redemption process failed. Please try again.'], 500);
        }
    }

    /**
     * Get available reward items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRewards(Request $request)
    {
        $rewards = RewardItem::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->where(function ($query) {
                $query->whereNull('quantity')->orWhere('quantity', '>', 0);
            })
            ->orderBy('points_cost', 'asc')
            ->get();

        return response()->json($rewards);
    }
}
