<?php

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

/**
 * TODO route riêng tương ứng với tên feature muốn xử lý,
 * Ví dụ: chức năng gửi mail => routes\admin_feature\Send_Mail.php
 */
foreach (glob(base_path('routes/admin_feature/*.php')) as $file) {
    include_once $file;
}

Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('tokens', TokenController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('manage-status-rooms', ManageStatusRoomController::class);
    Route::resource('asset-types', AssetTypeController::class);
    Route::resource('room-assets', RoomAssetController::class);
    Route::resource('phi-phat-sinh', PhiphatsinhController::class);
    Route::resource('payments', PaymentController::class);
    Route::prefix('change-password')->as('change-password.')->group(function () {
        Route::get('/', [ChangePasswordController::class, 'index']);
        Route::post('/change', [ChangePasswordController::class, 'ChangePassword'])->name('change_password');
    });
});

//Route test cắt giao diện admin
Route::get("/test", function () {
    return view('admin.index');
});
// Auth

Route::get('login', [LoginController::class, 'create'])
    ->name('login');



// Route::get('login', [LoginController::class, 'create'])
//     ->name('login');


// Route::post('login', [LoginController::class, 'store'])
//     ->name('login.store');


Route::get('/', [ScreenController::class, 'index'])
    ->name('screen');
//Detail
Route::get('/detail', [DetailController::class, 'index'])
    ->name('detail');
// // Users

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

// // Organizations

// Route::get('organizations', [OrganizationsController::class, 'index'])
//     ->name('organizations')
//     ->middleware('auth');

// Route::get('organizations/create', [OrganizationsController::class, 'create'])
//     ->name('organizations.create')
//     ->middleware('auth');

// Route::post('organizations', [OrganizationsController::class, 'store'])
//     ->name('organizations.store')
//     ->middleware('auth');

// Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
//     ->name('organizations.edit')
//     ->middleware('auth');

// Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
//     ->name('organizations.update')
//     ->middleware('auth');

// Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
//     ->name('organizations.destroy')
//     ->middleware('auth');

// Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
//     ->name('organizations.restore')
//     ->middleware('auth');

// // Contacts

// Route::get('contacts', [ContactsController::class, 'index'])
//     ->name('contacts')
//     ->middleware('auth');

// Route::get('contacts/create', [ContactsController::class, 'create'])
//     ->name('contacts.create')
//     ->middleware('auth');

// Route::post('contacts', [ContactsController::class, 'store'])
//     ->name('contacts.store')
//     ->middleware('auth');

// Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
//     ->name('contacts.edit')
//     ->middleware('auth');

// Route::put('contacts/{contact}', [ContactsController::class, 'update'])
//     ->name('contacts.update')
//     ->middleware('auth');

// Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
//     ->name('contacts.destroy')
//     ->middleware('auth');

// Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
//     ->name('contacts.restore')
//     ->middleware('auth');

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
