<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $policylink = url('/policy');
        $homelink = url('/');
        return $this->subject('Thông báo đăng nhập thành công')
            ->view('client.Mail.login-notification')
            ->with([
                'user' => $this->user,
                'policylink' => $policylink,
                'homelink' => $homelink,
                'loginTime' => now()->format('d-m-Y H:i:s'),
            ]);
    }
}
