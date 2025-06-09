<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource for the authenticated user.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'service_type' => 'required|string',
                'preferred_date' => 'required|date',
                'preferred_time' => 'required',
                'location' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'notes' => 'nullable|string',
                'user_car_id' => 'required|exists:user_cars,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $booking = new Booking();
            $booking->id = \Illuminate\Support\Str::uuid();
            $booking->user_id = auth()->id();
            $booking->user_car_id = $request->user_car_id;
            $booking->service_type = $request->service_type;
            $booking->preferred_date = $request->preferred_date;
            $booking->preferred_time = $request->preferred_time;
            $booking->location = $request->location;
            $booking->latitude = $request->latitude;
            $booking->longitude = $request->longitude;
            $booking->notes = $request->notes;
            $booking->status = 'pending';
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully',
                'data' => $booking
            ], 201);

        } catch (\Exception $e) {
            Log::error('Booking creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $booking = Booking::where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $booking
            ]);

        } catch (\Exception $e) {
            Log::error('Booking retrieval error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateLocation(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $booking = Booking::where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found'
                ], 404);
            }

            $booking->latitude = $request->latitude;
            $booking->longitude = $request->longitude;
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'Location updated successfully',
                'data' => $booking
            ]);

        } catch (\Exception $e) {
            Log::error('Location update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update location',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
