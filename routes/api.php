<?php


use App\Http\Controllers\Admin\SearchRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->get('/example', function (Request $request) {
    return response()->json(['message' => 'This is an example API response.']);
});


Route::post('search_room', [SearchRoomController::class, 'apiSearchRoom'])
    ->name('api.search_room');
// Route::get('/search', [RoomController::class, 'search'])
//     ->name('search');

