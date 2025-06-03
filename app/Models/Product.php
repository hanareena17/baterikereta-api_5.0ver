<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'battery_brand_id',
        'product_category_id',
        'battery_brand_series_id',
        'battery_size_id',
        'description',
        'image',
        'cost_price',
        'sale_price',
        'capacity',
        'cca',
        'voltage',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'cca' => 'integer',
        'voltage' => 'decimal:1',
    ];

    /**
     * Get the battery brand that owns the product.
     */
    public function batteryBrand(): BelongsTo
    {
        return $this->belongsTo(BatteryBrand::class);
    }

    /**
     * Get the product category that owns the product.
     */
    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Get the battery brand series that owns the product.
     */
    public function batteryBrandSeries(): BelongsTo
    {
        return $this->belongsTo(BatteryBrandSeries::class);
    }

    /**
     * Get the battery size that owns the product.
     */
    public function batterySize(): BelongsTo
    {
        return $this->belongsTo(BatterySize::class);
    }
}