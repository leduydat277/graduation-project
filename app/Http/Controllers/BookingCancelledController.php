<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingCancelled;
use App\Models\ManageStatusRoom;
use App\Models\Payment;
use App\Models\Reson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingCancelledController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reson = Reson::all();
        $view = view('client.cancelModal', compact('reson'))->render();
        return response()->json([
            'type' => 'success',
            'view' => $view,
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bookingId = $request->input('bookingId');
        $today = Carbon::now();

        $booking = Booking::where('id', $bookingId)->first();

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $reson = Reson::where('id', $request->input('reason_id'))->first();
        if (!$reson) {
            return response()->json(['error' => 'Reason not found'], 404);
        }

        $createdAt = Carbon::createFromTimestamp($booking->created_at);
        $checkInTime = Carbon::createFromTimestamp($booking->check_in_date);

        $refundAmount = 0;

        if ($today->diffInMinutes($createdAt) <= 60) {
            $refundAmount = '100';
        } elseif ($today->diffInMinutes($createdAt) > 60 && $today->lt($checkInTime->setTime(12, 0, 0))) {
            $refundAmount = '50';
        } elseif ($today->gte($checkInTime->setTime(12, 0, 0))) {
            $refundAmount = '0';
        }

        $manager_status = ManageStatusRoom::where('room_id', $booking->room_id)
            ->whereIn('status', [0, 1])
            ->orderByDesc('id')
            ->take(3)
            ->get();

        foreach ($manager_status as $status) {
            $status->delete();
        }

        $booking->status = 5;
        $booking->save();

        Payment::where('booking_id', $bookingId)->delete();

        if ($refundAmount = '100' || $refundAmount = '50') {
            BookingCancelled::create([
                'booking_id' => $bookingId,
                'reason' => $reson->reson,
                'description' => $request->input('description'),
                'refund' => $refundAmount,
                'cancelled_at' => $today->timestamp
            ]);
        } else {
            BookingCancelled::create([
                'booking_id' => $bookingId,
                'reason' => $reson->reson,
                'description' => $request->input('description'),
                'refund' => $refundAmount,
                'cancelled_at' => $today->timestamp,
                "status" => 'approved'
            ]);
        }

        return redirect()->route('client.home');
    }


    /**
     * Display the specified resource.
     */
    public function show(BookingCancelled $bookingCancelled)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingCancelled $bookingCancelled)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingCancelled $bookingCancelled)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingCancelled $bookingCancelled)
    {
        //
    }
}
