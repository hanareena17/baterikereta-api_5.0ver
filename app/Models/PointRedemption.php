<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PointRedemption extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'reward_item_id',
        'points_used',
        'status',
        'redeemed_at',
        'notes',
    ];

    protected $casts = [
        'points_used' => 'integer',
        'redeemed_at' => 'datetime',
    ];

    /**
     * Get the user who made the redemption.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reward item that was redeemed.
     */
    public function rewardItem()
    {
        return $this->belongsTo(RewardItem::class);
    }
}
