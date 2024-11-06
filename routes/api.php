<?php

use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->get('/example', function (Request $request) {
    return response()->json(['message' => 'This is an example API response.']);
});

// Route::get('/search', [RoomController::class, 'search'])
//     ->name('search');

Route::middleware('api')->group(function () {
    Route::get('/rooms', [RoomController::class, 'index']);
});
