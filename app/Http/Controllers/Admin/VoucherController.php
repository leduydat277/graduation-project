<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VoucherController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Voucher::where('quantity', 0)
        ->orWhere(function ($query) {
            $query->whereNotNull('end_date')
                  ->where('end_date', '<', now());
        })
        ->update(['status' => 0]);
        
        $title = "Quản lý Mã giảm giá";
        $query = Voucher::query();
        if ($request->has('code') && $request->code) {
            $query->where('code_voucher', 'like', '%' . $request->code . '%')
                  ->orWhere('name', 'like', '%' . $request->code . '%');
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        if ($request->has('min_discount') && $request->min_discount) {
            $query->where('discount_value', '>=', $request->min_discount);
        }

        if ($request->has('max_discount') && $request->max_discount) {
            $query->where('discount_value', '<=', $request->max_discount);
        }

        $vouchers = $query->paginate(10);

        return view('admin.vouchers.index', compact('vouchers', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mã giảm giá";
        return view('admin.vouchers.add', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code_voucher' => 'required|unique:vouchers,code_voucher',
            'type' => 'required|in:%,fixed',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'min_booking_amount' => 'required|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
        $minBookingAmount = floatval(str_replace('.', '', $request->min_booking_amount));
        Voucher::create(array_merge(
            $request->only([
                'name', 
                'description', 
                'code_voucher', 
                'type', 
                'discount_value', 
                'min_booking_amount', 
                'quantity', 
                'status'
            ]),
            [
                'min_booking_amount' => $minBookingAmount, 
                'start_date' => $request->start_date ? Carbon::parse($request->start_date)->timestamp : null,
                'end_date' => $request->end_date ? Carbon::parse($request->end_date)->timestamp : null,
            ]
        ));
        return redirect()->route('vouchers.index')->with('success', 'Voucher đã được thêm thành công.');
    }

    public function edit(Voucher $voucher)
    {
        $title = "Sửa mã giảm giá";
        return view('admin.vouchers.edit', compact('voucher', 'title'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:%,fixed',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'min_booking_amount' => 'required|min:0',
            'quantity' => 'required|integer|min:0',
        ]);
        $minBookingAmount = floatval(str_replace('.', '', $request->min_booking_amount));
        $voucher->update(array_merge(
            $request->only([
                'name', 
                'description', 
                'type', 
                'discount_value', 
                'min_booking_amount', 
                'quantity', 
                'status'
            ]),
            [
                'min_booking_amount' => $minBookingAmount, 
                'start_date' => $request->start_date ? Carbon::parse($request->start_date)->timestamp : null,
                'end_date' => $request->end_date ? Carbon::parse($request->end_date)->timestamp : null,
            ]
        ));
        return redirect()->route('vouchers.index')->with('success', 'Voucher đã được cập nhật.');
    }

    public function destroy(Voucher $voucher)
    {
        $bookings = Booking::all();
        foreach ($bookings as $booking){
            if ($booking->voucher_id == $voucher->id){
                return redirect()->route('vouchers.index')->with('error', 'Không thể xóa mã giảm giá vì có đơn hàng liên quan.');
            }
        }

        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher đã được xóa.');
    }
}
