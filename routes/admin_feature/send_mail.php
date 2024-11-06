<?php

use App\Http\Controllers\Admin\MailController;
use Illuminate\Support\Facades\Route;

// Nhóm route với prefix 'admin/users'
Route::prefix('admin/users')->group(function () {
    // Định nghĩa route cho hành động test trong UserController
    Route::get('test', [MailController::class, 'test_function'])->name('test');
});
