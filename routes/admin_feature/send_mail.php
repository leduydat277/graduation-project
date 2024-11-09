<?php

use App\Http\Controllers\Admin\MailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/mail')->controller(MailController::class)->group(function () {
    Route::get('sendMailCheckinCode', 'SendCheckinCode')->name('send_mail_check_in_code');
});
