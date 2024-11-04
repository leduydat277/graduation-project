<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->get('/example', function (Request $request) {
    return response()->json(['message' => 'This is an example API response.']);
});
