<?php


use App\Events\NotificationMessage;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ScreenController;
use App\Http\Controllers\Web\DetailController;
use App\Http\Controllers\Web\SuccesssController;
use App\Http\Controllers\Web\RoomsController;
use App\Http\Controllers\Web\CheckoutScreenController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Web\PaymentHistoryController;


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

include_once "admin.php";

Route::get("/test", function (Request $request) {
    event(new NotificationMessage('Lê Duy Linh', 'Đơn đặt phòng mới', 'dfjghidsgh'));
    return response()->json(['status' => 'Notification sent!']);
});

Route::get('/', [ScreenController::class, 'index'])
    ->name('screen');

Route::get('/about', [ScreenController::class, 'about'])
    ->name('about');

Route::get('/policy', [ScreenController::class, 'policy'])
    ->name('policy');
//Detail

Route::get('detail/{id}', [DetailController::class, 'detail'])->name('detail');

//Checkout
Route::get('/success', [SuccesssController::class, 'index'])
    ->name('success');


    Route::get('/payment-history', [PaymentHistoryController::class, 'index'])
    ->name('payment-history');

Route::get('/rooms', [RoomsController::class, 'index'])
    ->name('rooms');

Route::get('login', [LoginController::class, 'create'])
    ->name('login');
// ->middleware('guest');

Route::post('login', [LoginController::class, 'store'])
    ->name('login.store');
// ->middleware('guest');;

Route::delete('logout', [LoginController::class, 'destroy'])
    ->name('logout');
