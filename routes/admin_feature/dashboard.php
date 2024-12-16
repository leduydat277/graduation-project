<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Api\ProfileUserController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

// Route::prefix('admin')
//     ->as('admin.')
//     ->group(function () {
//         Route::get('/register', [DashBoardController::class, 'showRegisterForm'])->middleware(CheckLogin::class)->name('register');
//         Route::post('/register', [DashBoardController::class, 'register']);

//         Route::get('/login', [DashBoardController::class, 'showLoginForm'])->middleware(CheckLogin::class)->name('login');
//         Route::post('/login', [DashBoardController::class, 'login']);

//         Route::get('/logout', [DashBoardController::class, 'logout'])->name('logout');

//         // Route cho dashboard (bạn có thể tùy chỉnh theo nhu cầu)
//         Route::get('/dashboard', function () {
//             return view('admin.index'); // Giả sử bạn có view 'dashboard'
//         })->name('dashboard');
//     });

Route::prefix('api')
    ->group(function () {
    Route::get('profile', [ProfileUserController::class, 'profile'])->name('api.profile');
});
