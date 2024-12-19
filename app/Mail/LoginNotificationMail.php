<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $voucher;

    public function __construct($user, $voucher)
    {
        $this->user = $user;
        $this->voucher = $voucher;
    }

    public function build()
    {
        $policylink = url('/policy');
        $homelink = url('/');
        return $this->subject('Đăng ký thành công & Nhận voucher')
            ->view('client.Mail.login-notification')
            ->with([
                'user' => $this->user,
                'voucher' => $this->voucher,
                'policylink' => $policylink,
                'homelink' => $homelink,
            ]);
    }
}
