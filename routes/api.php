<?php


use App\Http\Controllers\Admin\SearchRoomController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->get('/example', function (Request $request) {
    return response()->json(['message' => 'This is an example API response.']);
});


Route::post('search_room', [SearchRoomController::class, 'apiSearchRoom'])
    ->name('api.search_room');


Route::post('booking', [BookingController::class, 'booking'])
    ->name('api.booking');

Route::get('donepayment', [BookingController::class, 'thanhtoan'])
    ->name('api.donepayment');
// Route::get('/search', [RoomController::class, 'search'])
//     ->name('search');
