<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

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
        $user = Auth::user();
        \Illuminate\Support\Facades\Log::info('Booking store request received:', $request->all());

        $validator = Validator::make($request->all(), [
            'service_type' => 'required|string|max:255',
            'preferred_date' => 'nullable|date',
            // Allow more flexible time format, or ensure frontend sends H:i
            'preferred_time' => 'nullable|string', // Changed from date_format:H:i for broader acceptance initially
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            \Illuminate\Support\Facades\Log::error('Booking validation failed:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $bookingData = [
            'user_id' => $user->id,
            'service_type' => $request->service_type,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time ? date('H:i:s', strtotime($request->preferred_time)) : null, // Ensure H:i:s format for DB
            'location' => $request->location,
            'notes' => $request->notes,
            'status' => 'pending', // Default status
        ];
        
        \Illuminate\Support\Facades\Log::info('Attempting to create booking with data:', $bookingData);

        try {
            $booking = Booking::create($bookingData);
            \Illuminate\Support\Facades\Log::info('Booking created successfully:', $booking->toArray());
            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully.',
                'data' => $booking
            ], 201);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating booking: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking. ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
