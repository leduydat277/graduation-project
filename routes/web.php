<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\RoomDetailController;

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
Route::get('/room', [HomeController::class, 'rooms'])
    ->name('client.room');

Route::post('/room-comment', [RoomDetailController::class, 'addComment'])
    ->name('client.room-postComment');
Route::get('/room/{id}', [RoomDetailController::class, 'index'])
    ->name('client.room-details');

Route::get('/blog-detail', [HomeController::class, 'index'])
    ->name('client.blog-detail');
Route::get('/booking', [HomeController::class, 'booking'])
    ->name('client.booking');


