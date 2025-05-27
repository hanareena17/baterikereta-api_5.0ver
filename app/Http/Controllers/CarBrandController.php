<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $brands = CarBrand::orderBy('name')->get();
            return response()->json($brands);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Error fetching car brands: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching car brands', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of models for a specific brand.
     *
     * @param  \App\Models\CarBrand  $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function models(CarBrand $brand) // Route model binding
    {
        try {
            // Assuming CarBrand model has a 'carModels' relationship defined
            // or CarModel has a 'car_brand_id'
            $models = CarModel::where('car_brand_id', $brand->id)->orderBy('name')->get();
            return response()->json($models);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Error fetching models for brand {$brand->id}: " . $e->getMessage());
            return response()->json(['message' => 'Error fetching car models', 'error' => $e->getMessage()], 500);
        }
    }

    // Note: The --api flag would have stubbed out store, show, update, destroy methods.
    // We are only implementing index and a custom 'models' method as per the routes.
    // You can remove the unused stubbed methods if you wish, or implement them if needed later.
}
