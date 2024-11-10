<?php

use App\Http\Controllers\Admin\SearchRoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/searchroom')->controller(SearchRoomController::class)->group(function () {
    Route::get('search_room/{room_type_id}/{input_people}/{date_in}/{date_out}/{id_room}', [SearchRoomController::class, 'searchRoom']);
});
