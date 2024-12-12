<?php


use App\Events\NotificationMessage;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ScreenController;
use App\Http\Controllers\Web\DetailController;
use App\Http\Controllers\Web\SuccesssController;
use App\Http\Controllers\Web\ConfirmationController;
use App\Http\Controllers\Web\RoomsController;
use App\Http\Controllers\Web\CheckoutScreenController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Web\PaymentHistoryController;
use App\Http\Controllers\Web\UsersController;


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
Route::get('/', [HomeController::class, 'index'])
    ->name('client.home');
Route::get('/about', [HomeController::class, 'index'])
    ->name('client.about');
Route::get('/services', [HomeController::class, 'index'])
    ->name('client.services');
Route::get('/blog', [HomeController::class, 'index'])
    ->name('client.blog');
Route::get('/policy', [HomeController::class, 'index'])
    ->name('client.policy');
Route::get('/room', [HomeController::class, 'index'])
    ->name('client.room');
Route::get('/room-details', [HomeController::class, 'index'])
    ->name('client.room-details');
Route::get('/blog-detail', [HomeController::class, 'index'])
    ->name('client.blog-detail');
Route::get('/booking', [HomeController::class, 'index'])
    ->name('client.booking');


