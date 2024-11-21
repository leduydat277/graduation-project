<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\ManageStatusRoomController;
use App\Http\Controllers\Admin\AssetTypeController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\CheckInCheckOutController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\OtherController;
use App\Http\Controllers\Admin\RoomAssetController;
use App\Http\Controllers\Admin\PhiphatsinhController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SearchRoomController;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('tokens', TokenController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('manage-status-rooms', ManageStatusRoomController::class);
    Route::resource('asset-types', AssetTypeController::class);
    Route::resource('room-assets', RoomAssetController::class);
    Route::resource('phi-phat-sinh', PhiphatsinhController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('others', OtherController::class);
    Route::prefix('change-password')->as('change-password.')->group(function () {
        Route::get('/', [ChangePasswordController::class, 'index']);
        Route::post('/change', [ChangePasswordController::class, 'ChangePassword'])->name('change_password');
    });
    Route::prefix('checkin-checkout')
        ->as('checkin-checkout.')
        ->group(function () {
            Route::get('/', [CheckInCheckOutController::class, 'index'])->name('index');
            Route::post('/checkin/{id}', [CheckInCheckOutController::class, 'checkIn'])->name('checkin');
            Route::post('/checkout/{id}', [CheckInCheckOutController::class, 'checkOut'])->name('checkout');
        });
});

Route::prefix('admin/searchroom')->controller(SearchRoomController::class)->group(function () {
    Route::get('search_room', [SearchRoomController::class, 'searchRoom']);
});

Route::prefix('admin/mail')->controller(MailController::class)->group(function () {
    Route::get('exampleSendMail', 'exampleMail');
    Route::get('sendMailCheckinCode', 'SendCheckinCode')->name('send_mail_check_in_code');
});

Route::get('/admin/logout', function () {
    Auth::logout();

    return redirect('/admin/login')->with('message', 'You have been logged out successfully.');
})->name('admin/ogout');

Route::prefix('admin')->group(function () {
    Route::get('{id}/export_pdf', [PaymentController::class, 'generatePDF'])->name('payments.export_pdf');
});

Route::prefix('admin')->group(function () {
    Route::get('room-types/{id}/rooms', [RoomTypeController::class, 'showroom'])->name('room-types.rooms');
});
