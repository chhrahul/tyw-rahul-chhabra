<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * get bookings records 
     */
    public function index(Request $request)
    {
        $query = Booking::query();

        // filter by start date and end date 
        if ($request->start_date) {
            $query->where('start_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->where('end_date', '<=', $request->end_date);
        }

        $bookings = $query->get();

        return response()->json($bookings);
    }

     /**
     * handle booking records store 
     */
    public function store(Request $request)
    {
        try {
            // validations 
            $validated = $request->validate([
                'customer_name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'yacht_name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'price' => 'required|numeric|max:1000000',
            ]);
            $booking = Booking::create($validated);
            return response()->json([
                'message' => 'Booking created successfully',
                'data' => $booking
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong while creating the booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Delete a booking
    public function destroy(Booking $booking)
    {
        try {
            $booking->delete();
            return response()->json([
                'message' => 'Booking deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
