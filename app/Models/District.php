<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the outlets for the district.
     */
    public function outlets(): HasMany
    {
        return $this->hasMany(Outlet::class);
    }
}