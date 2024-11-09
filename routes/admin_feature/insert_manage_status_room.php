<?php

use App\Http\Controllers\Admin\SearchRoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/')->controller(SearchRoomController::class)->group(function () {
    Route::get('insert_manage_status_room', [SearchRoomController::class, 'searchRoom'])
        ->name('insert_manage_status_room');
});
