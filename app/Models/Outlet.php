<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlet extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'address1',
        'address2',
        'address3',
        'postcode',
        'city',
        'state',
        'contact',
        'image_url',
        'map_embed_code',
        'district_id',
    ];

    /**
     * Get the district that owns the outlet.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the map links for the outlet.
     */
    public function mapLinks(): HasMany
    {
        return $this->hasMany(OutletMapLink::class);
    }

    /**
     * Get the formatted address.
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address1}, {$this->address2}, {$this->address3}, {$this->postcode} {$this->city}, {$this->state}";
    }
}