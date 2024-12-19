<?php


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OtherController;
use App\Http\Controllers\Admin\SearchRoomController;
use App\Http\Controllers\Api\AssetTypeController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomTypeController;
// use App\Http\Controllers\Web\DetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginedController;
use App\Http\Controllers\Api\VoucherController;

// Define your API routes here
Route::middleware('api')->get('/example', function (Request $request) {
    return response()->json(['message' => 'This is an example API response.']);
});

Route::middleware('api')->group(function () {
    Route::get('/rooms', [RoomController::class, 'index']);
    Route::get('/rooms/booking', [RoomController::class, 'getRoomBooking']);
});


Route::get('search', [SearchRoomController::class, 'searchRoom'])
    ->name('api.search_room');

// Admin api
Route::get('dashboard', [DashboardController::class, 'statistical'])->name('api.dashboard');
Route::get('getBookingsToday', [DashboardController::class, 'getBookingsToday'])->name('api.getBookingsToday');
Route::get('thongKeTongThe', [DashboardController::class, 'thongKeTongThe'])->name('api.thongKeTongThe');
Route::get('assetsDie', [DashboardController::class, 'assetsDie'])->name('api.assetsDie');
Route::get('getWeeks', [DashboardController::class, 'getWeeksInCurrentMonth'])->name('api.getWeeks');
Route::get('countRoomOrders', [DashboardController::class, 'countRoomOrders'])->name('api.countRoomOrders');
Route::get('/notifications', [NotificationsController::class, 'showNotifications']);
Route::post('/notifications/delete', [NotificationsController::class, 'deleteNotifications']);
Route::post('/notifications/read', [NotificationsController::class, 'readNotifications']);


Route::get('checkDate{id}', [BookingController::class, 'checkDate'])
    ->name('api.checkDate');

Route::post('confirm', [BookingController::class, 'confirmInfor'])
    ->name('api.confirmInfor');

Route::post('booking', [BookingController::class, 'booking'])
    ->name('api.booking');

Route::get('redirectDetailBooking', [BookingController::class, 'redirectDetailBooking'])
    ->name('api.redirectDetailBooking');

Route::post('voucher', [VoucherController::class, 'checkVoucher'])
    ->name('api.voucher');

Route::get('logined', [LoginedController::class, 'index'])->name('api.logined');
Route::get('all-payment', [PaymentController::class, 'allPayments'])
    ->name('api.all-payment');

Route::post('filter-payment', [PaymentController::class, 'filterPayments'])
    ->name('api.filter-payment');

Route::get('donepayment', [BookingController::class, 'vnpay'])
    ->name('api.donepayment');

// Route::get('detail/{id}', [DetailController::class, 'detail'])
//     ->name('api.detail');

Route::get('all-rooms', [RoomController::class, 'index'])->name('api.rooms');
Route::get('all-room-types', [RoomTypeController::class, 'index'])->name('api.room-types');

Route::get('policy', [OtherController::class, 'policy'])->name('api.policy');
Route::get('privacy', [OtherController::class, 'privacy'])->name('api.privacy');

Route::get('test', function () {
    return 'API is working!';
});

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/all-asset-types', AssetTypeController::class . '@index');

Route::get('rooms/all', [RoomController::class, 'roomAll'])->name('api.rooms.all');