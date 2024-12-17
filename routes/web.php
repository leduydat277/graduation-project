<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\BookingCancelledController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RoomDetailController;
use App\Http\Controllers\Web\SeviceController;
use App\Http\Middleware\CheckLoginMiddleware;

include_once "admin.php";
Route::get('/', [HomeController::class, 'index'])
    ->name('client.home');
Route::get('/about', [HomeController::class, 'about'])
    ->name('client.about');
Route::get('/services', [SeviceController::class, 'services'])
    ->name('client.services');
Route::get('/services/{id}', [SeviceController::class, 'show'])
    ->name('client.services-detail');
Route::get('/blog', [HomeController::class, 'blog'])
    ->name('client.blog');
Route::get('/policy', [HomeController::class, 'policy'])
    ->name('client.policy');
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('client.contact');
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
    ->name('client.booking')->middleware(CheckLoginMiddleware::class . ':auth-only');
Route::get('/detail-booking/{bookingNumberId}', [HomeController::class, 'booking_detail'])
    ->name('client.detail_booking');
Route::get('/cancelBooking', [BookingCancelledController::class, 'index'])
    ->name('cancelBooking.index');
Route::post('/cancelBooking/store', [BookingCancelledController::class, 'store'])
    ->name('cancelBooking.store');

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('client.login')->middleware(CheckLoginMiddleware::class . ':guest-only');
    Route::post('/login', [LoginController::class, 'login'])->name('client.loginRequest');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('client.register')->middleware(CheckLoginMiddleware::class . ':guest-only');
    Route::post('/register', [LoginController::class, 'register'])->name('client.registerRequest');
    Route::get('/logout', [LoginController::class, 'logout'])->name('client.logout');
    Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('client.forgotPassword')->middleware(CheckLoginMiddleware::class . ':guest-only');
    Route::post('/forgot-password', [LoginController::class, 'sendMailForgotPassword'])->name('client.sendMailForgotPassword')->middleware(CheckLoginMiddleware::class . ':guest-only');
    Route::get('/reset-password', [LoginController::class, 'resetPasswordView'])->name('client.resetPasswordView')->middleware(CheckLoginMiddleware::class . ':guest-only');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('client.resetPassword');
});
