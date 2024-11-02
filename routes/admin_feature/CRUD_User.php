<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

// Nhóm route với prefix 'admin/users'
Route::prefix('admin/users')->group(function () {
    // Định nghĩa route cho hành động test trong UserController
    Route::get('test', [UserController::class, 'test_function'])->name('test');
});
