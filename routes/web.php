<?php

use App\Events\NotificationMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ScreenController;
use App\Http\Controllers\Web\DetailController;
<<<<<<< HEAD
use App\Http\Controllers\Web\SuccesssController;
use App\Http\Controllers\Web\RoomsController;
=======
use App\Http\Controllers\Web\CheckoutScreenController;
use Illuminate\Support\Facades\Request;

>>>>>>> cad47aa01201fe9fa71882b16cbb914166350bc0
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
    event(new NotificationMessage('Lê Duy Linh','Đơn đặt phòng mới', 'dfjghidsgh'));
    return response()->json(['status' => 'Notification sent!']);
});


Route::get('/', [ScreenController::class, 'index'])
    ->name('screen');
//Detail
Route::get('/detail', [DetailController::class, 'index'])
    ->name('detail');
Route::get('detail/{id}', [DetailController::class, 'detail'])->name('detail');

//Checkout
Route::get('/success', [SuccesssController::class, 'index'])
    ->name('success');

Route::get('/rooms', [RoomsController::class, 'index'])
    ->name('rooms');    