<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUuids; // Assuming you have a UUID trait

class CarCompatibleBattery extends Model
{
    use HasFactory, HasUuids; // Added HasUuids

    protected $table = 'car_compatible_battery'; // Explicitly define table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'car_model_id',
        'battery_sizes', // This column stores battery_size_id
    ];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';


    /**
     * Get the car model that this compatibility record belongs to.
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    /**
     * Get the battery size that this compatibility record refers to.
     * Note: The column name is 'battery_sizes' but it stores a single battery_size_id.
     */
    public function batterySize(): BelongsTo
    {
        return $this->belongsTo(BatterySize::class, 'battery_sizes');
    }
}
