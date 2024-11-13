<?php

use App\Http\Controllers\Admin\CheckInController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/')->controller(CheckInController::class)->group(function () {
    Route::get('check_in_booking/{booking_id}', [CheckInController::class, 'CheckIn'])
        ->name('check_in_booking');
});