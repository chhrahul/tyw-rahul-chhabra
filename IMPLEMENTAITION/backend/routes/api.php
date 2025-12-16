<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;


// Booking Routes

Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);

