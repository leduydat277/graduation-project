<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $resetLink = url('/auth/reset-password/?token=' . $this->token);
        return $this->subject('Đặt lại mật khẩu của bạn')
                    ->view('client.Mail.reset-password-mail')
                    ->with(['resetLink' => $resetLink]);
    }
}
