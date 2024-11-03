<?php

use App\Http\Controllers\FE\FeRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->get('/example', function (Request $request) {
    return response()->json(['message' => 'This is an example API response.']);
});

// Route::get('/search', [RoomController::class, 'search'])
//     ->name('search');
Route::get('fe/rooms', [FeRoomController::class, 'getRooms'])->name('api.fe.rooms');
