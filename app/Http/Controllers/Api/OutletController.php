<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Outlet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Get all outlets.
     */
    public function index(): JsonResponse
    {
        $outlets = Outlet::with(['district', 'mapLinks'])->get();

        $formattedOutlets = $outlets->map(function ($outlet) {
            $googleMapLink = $outlet->mapLinks->where('service', 'google_maps')->first()?->map_link;
            $wazeLink = $outlet->mapLinks->where('service', 'waze')->first()?->map_link;
            
            return [
                'id' => $outlet->id,
                'name' => $outlet->name,
                'address' => $outlet->full_address,
                'contact' => $outlet->contact,
                'image_url' => $outlet->image_url,
                'map_embed_code' => $outlet->map_embed_code,
                'district' => $outlet->district->name,
                'google_maps_link' => $googleMapLink,
                'waze_link' => $wazeLink,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedOutlets,
        ]);
    }

    /**
     * Get outlets by district.
     */
    public function getByDistrict(string $districtId): JsonResponse
    {
        $district = District::findOrFail($districtId);
        $outlets = $district->outlets()->with('mapLinks')->get();

        $formattedOutlets = $outlets->map(function ($outlet) {
            $googleMapLink = $outlet->mapLinks->where('service', 'google_maps')->first()?->map_link;
            $wazeLink = $outlet->mapLinks->where('service', 'waze')->first()?->map_link;
            
            return [
                'id' => $outlet->id,
                'name' => $outlet->name,
                'address' => $outlet->full_address,
                'contact' => $outlet->contact,
                'image_url' => $outlet->image_url,
                'map_embed_code' => $outlet->map_embed_code,
                'district' => $outlet->district->name,
                'google_maps_link' => $googleMapLink,
                'waze_link' => $wazeLink,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $formattedOutlets,
        ]);
    }

    /**
     * Get a specific outlet.
     */
    public function show(string $id): JsonResponse
    {
        $outlet = Outlet::with(['district', 'mapLinks'])->findOrFail($id);
        
        $googleMapLink = $outlet->mapLinks->where('service', 'google_maps')->first()?->map_link;
        $wazeLink = $outlet->mapLinks->where('service', 'waze')->first()?->map_link;
        
        $formattedOutlet = [
            'id' => $outlet->id,
            'name' => $outlet->name,
            'address' => $outlet->full_address,
            'contact' => $outlet->contact,
            'image_url' => $outlet->image_url,
            'map_embed_code' => $outlet->map_embed_code,
            'district' => $outlet->district->name,
            'google_maps_link' => $googleMapLink,
            'waze_link' => $wazeLink,
        ];

        return response()->json([
            'status' => 'success',
            'data' => $formattedOutlet,
        ]);
    }
}