<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Reservation;
use App\Models\Contact;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/reservations/unread', function () {
    return ['count' => \App\Models\Reservation::where('is_read', false)->count()];
});

Route::get('/admin/contacts/unread', function () {
    return ['count' => \App\Models\Contact::where('is_read', false)->count()];
});

Route::get('/admin/notifications/unread', function () {
    return response()->json([
        'reservations' => Reservation::where('is_read', false)->count(),
        'contacts'     => Contact::where('is_read', false)->count(),
    ]);
});
