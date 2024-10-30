<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Status;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::query()->get();
        $status = "";
        foreach ($payments as $payment) {
            $status = Status::where('id', '=', $payment->status_id)->first();
        }
        return view('admin.payments.list', compact('payments', 'status'));
    }
    // public function index()
    // {
    //     $payments = Payment::query()->get();
    //     $status = "";
    //     foreach ($payments as $payment) {
    //         $status = Status::where('id', '=', $payment->status_id)->first();
    //     }
    //     foreach ($payments as $payment) {
    //         // Lấy thông tin booking
    //         $booking = Booking::find($payment->booking_id); 
    //         // Lấy thông tin user từ booking
    //         if ($booking) {
    //             $user = User::where('id','=', $booking->user_id)->first();               
    //             $payment->user_name = $user ? $user->name : ''; 
    //             dd($user->toArray());
    //         } else {
    //             $user = ''; 
    //         }

    //         // Lấy trạng thái thanh toán
    //         $status = Status::find($payment->status_id);
    //         $payment->status_name = $status ? $status->name : ''; // Gán tên trạng thái vào payment
    //     }
    //     dd($payments);
    //     return view('admin.payments.list', compact('payments', 'status'));
    // }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with('booking.detailBookings.roomType.roomTypeImages')
            ->where('id', $id)
            ->first();
        return view('admin.payments.show', compact('payment'));
    }

}
