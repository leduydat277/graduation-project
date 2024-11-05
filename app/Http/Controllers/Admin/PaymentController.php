<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $payments = Payment::with(['booking.user', 'status'])->get();
            foreach ($payments as $payment) {
            } 
            return view('admin.payments.list', compact('payments'));
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with([
            'booking.detailBookings.roomType.roomTypeImages',
            'booking.detailBookings.room.damageReports'])
            ->where('id', $id)
            ->first();
        return view('admin.payments.show', compact('payment'));
    }

}
