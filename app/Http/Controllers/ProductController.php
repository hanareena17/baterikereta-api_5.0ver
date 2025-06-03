<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BatteryBrand;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Get all products.
     */
    public function index(): JsonResponse
    {
        $products = Product::with([
            'batteryBrand', 
            'productCategory', 
            'batteryBrandSeries', 
            'batterySize'
        ])->get();

        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'battery_brand_id' => $product->battery_brand_id,
                'product_category_id' => $product->product_category_id,
                'battery_brand_series_id' => $product->battery_brand_series_id,
                'battery_size_id' => $product->battery_size_id,
                'description' => $product->description,
                'image' => $product->image ? asset('images/' . $product->image) : null,
                'cost_price' => $product->cost_price,
                'sale_price' => $product->sale_price,
                'capacity' => $product->capacity,
                'cca' => $product->cca,
                'voltage' => $product->voltage,
                'battery_brand' => $product->batteryBrand->name ?? null,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedProducts,
        ]);
    }

    /**
     * Get products by battery brand.
     */
    public function getByBatteryBrand(string $batteryBrandId): JsonResponse
    {
        try {
            // Log the incoming request
            Log::info('Received request for products by battery brand', [
                'battery_brand_id' => $batteryBrandId
            ]);

            // Check if battery brand exists
            $batteryBrand = BatteryBrand::find($batteryBrandId);
            
            if (!$batteryBrand) {
                Log::warning('Battery brand not found', [
                    'battery_brand_id' => $batteryBrandId
                ]);
                
                return response()->json([
                    'status' => 'error',
                    'message' => 'Battery brand not found'
                ], 404);
            }

            // Log the battery brand details
            Log::info('Found battery brand', [
                'brand_id' => $batteryBrand->id,
                'brand_name' => $batteryBrand->name
            ]);

            // Get products with eager loading
            $products = $batteryBrand->products()
                ->with([
                    'productCategory', 
                    'batteryBrandSeries', 
                    'batterySize'
                ])
                ->get();

            // Log the products count
            Log::info('Products found', [
                'brand_id' => $batteryBrandId,
                'products_count' => $products->count()
            ]);

            // Format the products
            $formattedProducts = $products->map(function ($product) use ($batteryBrand) {
                return [
                    'id' => $product->id,
                    'battery_brand_id' => $product->battery_brand_id,
                    'product_category_id' => $product->product_category_id,
                    'battery_brand_series_id' => $product->battery_brand_series_id,
                    'battery_size_id' => $product->battery_size_id,
                    'description' => $product->description,
                    'image' => $product->image ? asset('images/' . $product->image) : null,
                    'cost_price' => $product->cost_price,
                    'sale_price' => $product->sale_price,
                    'capacity' => $product->capacity,
                    'cca' => $product->cca,
                    'voltage' => $product->voltage,
                    'battery_brand' => $batteryBrand->name,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $formattedProducts,
            ]);

        } catch (\Exception $e) {
            // Log detailed error information
            Log::error('Error in getByBatteryBrand', [
                'battery_brand_id' => $batteryBrandId,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'error_trace' => $e->getTraceAsString()
            ]);

            // Check database connection
            try {
                DB::connection()->getPdo();
                Log::info('Database connection is working');
            } catch (\Exception $dbError) {
                Log::error('Database connection error', [
                    'error' => $dbError->getMessage()
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch products for this battery brand',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific product.
     */
    public function show(string $id): JsonResponse
    {
        $product = Product::with([
            'batteryBrand', 
            'productCategory', 
            'batteryBrandSeries', 
            'batterySize'
        ])->findOrFail($id);
        
        $formattedProduct = [
            'id' => $product->id,
            'battery_brand_id' => $product->battery_brand_id,
            'product_category_id' => $product->product_category_id,
            'battery_brand_series_id' => $product->battery_brand_series_id,
            'battery_size_id' => $product->battery_size_id,
            'description' => $product->description,
            'image' => $product->image ? asset('images/' . $product->image) : null,
            'cost_price' => $product->cost_price,
            'sale_price' => $product->sale_price,
            'capacity' => $product->capacity,
            'cca' => $product->cca,
            'voltage' => $product->voltage,
            'battery_brand' => $product->batteryBrand->name ?? null,
        ];

        return response()->json([
            'status' => 'success',
            'data' => $formattedProduct,
        ]);
    }
}