<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuids; // Import the HasUuids trait
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory, HasUuids; // Use HasUuids trait

    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'user_car_id',
        'service_type',
        'preferred_date',
        'preferred_time',
        'location',
        'latitude',
        'longitude',
        'notes',
        'status'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userCar()
    {
        return $this->belongsTo(UserCar::class);
    }
}
