<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaymentController;


Route::prefix('admin')->group(function () {
    Route::get('/export_pdf', [PaymentController::class, 'index'])->name('payments.export_pdf');
});