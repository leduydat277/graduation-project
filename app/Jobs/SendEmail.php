<?php

namespace App\Jobs;

use App\Http\Controllers\Admin\MailController as AdminMailController;
use App\Http\Controllers\MailController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $view;
    protected $subject;
    protected $recipientEmail;

    // Constructor nhận dữ liệu linh hoạt
    public function __construct($data, $view, $subject, $recipientEmail)
    {
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
        $this->recipientEmail = $recipientEmail;
    }

    // Xử lý gửi email
    public function handle()
    {
        $mail = new AdminMailController();

        $mail->SendCheckinCode($this->subject, $this->view, $this->data, $this->recipientEmail);
    }
}
