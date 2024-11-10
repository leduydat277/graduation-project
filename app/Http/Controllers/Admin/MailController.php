<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Exception;

class MailController extends Controller
{
    public function exampleMail()
    {
        $data = [
            'checkin_code' => '123456',
            'check_in_date' => '2024-11-10',
            'check_out_date' => '2024-11-15',
            'name' => 'Nguyen'
        ];
        $email_user = 'linhduyle6a1@gmail.com';

        $mailController = new MailController();
        return $mailController->SendCheckinCode('Check-in Code', 'checkincode', $data, $email_user);
    }

    public function SendCheckinCode($subject, $view, $data, $email_user)
    {
        $data = [
            'subject' => $subject,
            'view' => 'admin.mail.' . $view,
            'data_view' => $data,
        ];

        try {
            $sendMail = new SendMail($data);
            Mail::to($email_user)->send($sendMail);
            return response()->json(['message' => 'Email sent successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
        }
    }
}
