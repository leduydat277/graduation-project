<?php

<<<<<<< HEAD

=======
>>>>>>> f6b74a7e5d61d0056615acca06edf2a3b1fb00af
use App\Events\NotificationMessage;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ScreenController;
use App\Http\Controllers\Web\DetailController;
use App\Http\Controllers\Web\SuccesssController;
use App\Http\Controllers\Web\RoomsController;
use App\Http\Controllers\Web\CheckoutScreenController;
use Illuminate\Support\Facades\Request;
<<<<<<< HEAD

=======
>>>>>>> f6b74a7e5d61d0056615acca06edf2a3b1fb00af

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
//Detail
<<<<<<< HEAD

Route::get('/detail', [DetailController::class, 'index'])
    ->name('detail');
// // Users
Route::get('/about', [AboutController::class, 'index'])
    ->name('about');
Route::get('/policy', [PolyciController::class, 'index'])
    ->name('policy');

// Route::delete('logout', [LoginController::class, 'destroy'])
//     ->name('logout');

// // // Screen


// Route::get('/', [ScreenController::class, 'index'])
//     ->name('screen');

// // // Users

// Route::get('users', [UsersController::class, 'index'])
//     ->name('users');
//     ->middleware('auth');

// Route::get('users/create', [UsersController::class, 'create'])
//     ->name('users.create')
//     ->middleware('auth');

// Route::post('users', [UsersController::class, 'store'])
//     ->name('users.store')
//     ->middleware('auth');

// Route::get('users/{user}/edit', [UsersController::class, 'edit'])
//     ->name('users.edit')
//     ->middleware('auth');

// Route::put('users/{user}', [UsersController::class, 'update'])
//     ->name('users.update')
//     ->middleware('auth');

// Route::delete('users/{user}', [UsersController::class, 'destroy'])
//     ->name('users.destroy')
//     ->middleware('auth');

// Route::put('users/{user}/restore', [UsersController::class, 'restore'])
//     ->name('users.restore')
//     ->middleware('auth');

// //Payments

// Route::get('payment/', [AdminPaymentController::class, 'index'])->name('index');
// Route::get('payment/{id}/show', [AdminPaymentController::class, 'show'])->name('payment.show');

// // Reports

// Route::get('reports', [ReportsController::class, 'index'])
//     ->name('reports')
//     ->middleware('auth');

// // Images

// Route::get('/img/{path}', [ImagesController::class, 'show'])
//     ->where('path', '.*')
//     ->name('image');

// //Booking
// Route::prefix('booking')
//     ->as('booking.')
//     ->group(function () {
//         Route::get('/', [BookingController::class, 'index'])->name('index');
//         Route::get('/list', [BookingController::class, 'list'])->name('list');
//         Route::get('/detail/{id}', [BookingController::class, 'detail'])->name('detail');
//     });

// //Payment
// Route::prefix('payment')
    // ->as('payment.')
    // ->group(function () {
    //     Route::get('/', [AdminPaymentController::class, 'index'])->name('index');
    //     Route::get('/{id}/show', [AdminPaymentController::class, 'show'])->name('show');
    // });
    // ->name('detail');
=======
Route::get('detail/{id}', [DetailController::class, 'detail'])->name('detail');

//Checkout
Route::get('/success', [SuccesssController::class, 'index'])
    ->name('success');

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
>>>>>>> f6b74a7e5d61d0056615acca06edf2a3b1fb00af
