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
use App\Http\Controllers\Admin\RoomAssetController;
use App\Http\Controllers\Admin\PhiphatsinhController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Api\BookingController as ApiBookingController;
use App\Http\Controllers\Web\ScreenController;
use App\Http\Controllers\Web\DetailController;
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

Route::get("/test", function () {
    return view('admin.index');
});


Route::get('/', [ScreenController::class, 'index'])
    ->name('screen');
//Detail
Route::get('/detail', [DetailController::class, 'index'])
    ->name('detail');