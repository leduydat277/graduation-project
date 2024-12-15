<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthenticationController;

use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\BookingCancelledController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RoomDetailController;
use App\Http\Controllers\Web\SeviceController;

include_once "admin.php";
Route::get('/', [HomeController::class, 'index'])
    ->name('client.home');
Route::get('/about', [HomeController::class, 'about'])
    ->name('client.about');
Route::get('/services', [SeviceController::class, 'services'])
    ->name('client.services');
Route::get('/services/{id}', [SeviceController::class, 'show'])
    ->name('client.services-detail');
Route::get('/blog', [HomeController::class, 'index'])
    ->name('client.blog');
Route::get('/policy', [HomeController::class, 'index'])
    ->name('client.policy');
Route::get('/room', [HomeController::class, 'rooms'])
    ->name('client.room');

Route::post('/room-comment/{id}', [ReviewController::class, 'addComment'])
    ->name('client.room-postComment');
Route::get('review/{id}', [ReviewController::class, 'review'])
    ->name('client.review');
Route::get('/room/{id}', [RoomDetailController::class, 'index'])
    ->name('client.room-details');
Route::get('/blog-detail', [HomeController::class, 'index'])
    ->name('client.blog-detail');
Route::get('/booking', [HomeController::class, 'booking'])
    ->name('client.booking');
Route::prefix("authentication")->name("authentication.")->group(function() {
    Route::get('/login', [AuthenticationController::class, 'loginUI'])->name('loginUI');
    Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');

    Route::get('/register', [AuthenticationController::class, 'registerUI'])->name('registerUI');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('postRegister');

});
Route::get("/account", [UsersController::class, "getUser"])->name("account");


Route::get('/detail-booking/{bookingNumberId}', [HomeController::class, 'booking_detail'])
    ->name('client.detail_booking');
Route::get('/cancelBooking', [BookingCancelledController::class, 'index'])
    ->name('cancelBooking.index');
Route::post('/cancelBooking/store', [BookingCancelledController::class, 'store'])
    ->name('cancelBooking.store');

