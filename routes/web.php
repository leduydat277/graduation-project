<?php

use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthenticationController;

use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\BookingCancelledController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PaymentsController;
use App\Http\Controllers\Web\RoomDetailController;
use App\Http\Controllers\Web\SeviceController;
use App\Http\Controllers\Web\UsersController as WebUsersController;
use App\Http\Middleware\CheckLoginMiddleware;

include_once "admin.php";
Route::get('/', [HomeController::class, 'index'])
    ->name('client.home')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/about', [HomeController::class, 'about'])
    ->name('client.about')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/services', [SeviceController::class, 'services'])
    ->name('client.services')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/services/{id}', [SeviceController::class, 'show'])
    ->name('client.services-detail')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/blog', [HomeController::class, 'blog'])
    ->name('client.blog')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/policy', [HomeController::class, 'policy'])
    ->name('client.policy')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('client.contact');
Route::get('/room', [HomeController::class, 'rooms'])
    ->name('client.room')->middleware(CheckLoginMiddleware::class . ':admin-only');

Route::post('/room-comment/{id}', [ReviewController::class, 'addComment'])
    ->name('client.room-postComment')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('review/{id}', [ReviewController::class, 'review'])
    ->name('client.review')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/room/{id}', [RoomDetailController::class, 'index'])
    ->name('client.room-details')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/blog-detail', [HomeController::class, 'index'])
    ->name('client.blog-detail')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/booking', [HomeController::class, 'booking'])
    ->name('client.booking');

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
})->middleware(CheckLoginMiddleware::class . ':admin-only');

Route::get("/account", [WebUsersController::class, "getUser"])->name("account")->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::put("/account/{id}", [WebUsersController::class, "updateProficeUser"])->name("updateProficeUser")->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get("/confirm-password", [WebUsersController::class, "updatePasswordUserUI"])->name("updatePasswordUserUI")->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::post("/account/password/{id}", [WebUsersController::class, "updatePasswordUser"])->name("updatePassword")->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get("/payment-history", [PaymentsController::class, "paymentHistory"])->name("paymentHistory")->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get("/booking-list", [HomeController::class, "getBookingList"])->name("getBookingList")->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get("/payment-history-detail/{id}", [PaymentsController::class, "paymentHistoryDetail"])->name("paymentHistoryDetail")->middleware(CheckLoginMiddleware::class . ':admin-only');

Route::get('/detail-booking/{bookingNumberId}', [HomeController::class, 'booking_detail'])
    ->name('client.detail_booking')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/done-booking/{bookingNumberId}', [HomeController::class, 'done_booking_detail'])
    ->name('client.done_booking')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/cancelBooking', [BookingCancelledController::class, 'index'])
    ->name('cancelBooking.index')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::get('/reviewModal', [AdminReviewController::class, 'modal'])
    ->name('reviewModal.modal')->middleware(CheckLoginMiddleware::class . ':admin-only');
Route::post('/cancelBooking/store', [BookingCancelledController::class, 'store'])
    ->name('cancelBooking.store')->middleware(CheckLoginMiddleware::class . ':admin-only');
