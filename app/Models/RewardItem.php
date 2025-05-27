<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RewardItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'points_cost',
        'image_url',
        'is_active',
        'quantity',
        'valid_from',
        'valid_until',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'points_cost' => 'integer',
        'quantity' => 'integer',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    /**
     * Get the redemptions associated with this reward item.
     */
    public function redemptions()
    {
        return $this->hasMany(PointRedemption::class);
    }
}
