<?php

use App\Http\Controllers\AdditionalServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentProofController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/userbookings', [BookingController::class, 'userbooking']);

    Route::get('/portfolio', [PortfolioController::class, 'index']);
    Route::post('/portfolio', [PortfolioController::class, 'store']);
    Route::put('/portfolio/:id', [PortfolioController::class, 'update']);
    Route::delete('/portfolio/:id', [PortfolioController::class, 'destroy']);

    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/:id', [ServiceController::class, 'update']);
    Route::delete('/services/:id', [ServiceController::class, 'destroy']);

    Route::get('/services/:id/bookings', [ServiceController::class, 'bookings']);
    Route::get('/services/:id/additional-services', [ServiceController::class, 'additionalServices']);

    Route::get('/additional-services', [AdditionalServiceController::class, 'index']);
    Route::post('/additional-services', [AdditionalServiceController::class, 'store']);
    Route::put('/additional-services/:id', [AdditionalServiceController::class, 'update']);
    Route::delete('/additional-services/:id', [AdditionalServiceController::class, 'destroy']);

    Route::get('/additional-services/:id', [AdditionalServiceController::class, 'show']);
    Route::get('/additional-services/:id/service', [AdditionalServiceController::class, 'service']);

    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/all', [BookingController::class, 'getAllBooking']);
    Route::put('/bookings/:id', [BookingController::class, 'update']);
    Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirmBooking']);
    Route::post('/bookings/{id}/reject', [BookingController::class, 'rejectBooking']);
    Route::delete('/bookings/:id', [BookingController::class, 'destroy']);

    Route::get('/bookings/:id', [BookingController::class, 'show']);
    Route::get('/bookings/:id/user', [BookingController::class, 'user']);
    Route::get('/bookings/:id/service', [BookingController::class, 'service']);
    Route::get('/bookings/:id/payment-proof', [BookingController::class, 'paymentProof']);
    Route::get('/bookings/:id/additional-services', [BookingController::class, 'additionalServices']);

    Route::get('/payment-proofs', [PaymentProofController::class, 'index']);
    Route::post('/payment-proofs', [PaymentProofController::class, 'store']);
    Route::put('/payment-proofs/:id', [PaymentProofController::class, 'update']);
    Route::delete('/payment-proofs/:id', [PaymentProofController::class, 'destroy']);

    Route::get('/payment-proofs/:id', [PaymentProofController::class, 'show']);
    Route::get('/payment-proofs/:id/booking', [PaymentProofController::class, 'booking']);
});
