<?php

use App\Http\Controllers\Admin\AssetTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoomAssetController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

Route::get('login', [LoginController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [LoginController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [LoginController::class, 'destroy'])
    ->name('logout');



Route::prefix('admin')
    ->as('admin.')
    // ->middleware(Role::class) // Admin có tất cả các quyền
    ->group(function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('user', UserController::class);
        Route::resource('booking', BookingController::class);
        Route::resource('payment', PaymentController::class);
        Route::resource('room', RoomController::class);
        Route::resource('room-type', RoomTypeController::class);
        Route::resource('room-asset', RoomAssetController::class);
        Route::resource('asset-type', AssetTypeController::class);
        Route::resource('review', ReviewController::class);

        $loadroute = File::allFiles(__DIR__ . '/admin-feature');
        foreach ($loadroute as $file) {
            // dd($file->getRealPath());
            require_once $file->getPathname();
        }
    });
