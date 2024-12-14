<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;



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
Route::prefix("authentication")->name("authentication.")->group(function() {
    Route::get('/login', [AuthenticationController::class, 'loginUI'])->name('loginUI');
    Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');

    Route::get('/register', [AuthenticationController::class, 'registerUI'])->name('registerUI');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('postRegister');

});


