<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController
{
    public function review($id)
    {
        $title = "Đánh giá & bình luận";
        $booking = Booking::with(['room', 'user'])->findOrFail($id);
        $comments = Review::where('room_id', $booking->room->id)
            ->with('user')
            ->get();
        return view('client.review', compact('title', 'booking', 'comments'));
    }

    public function addComment(Request $request, $id)
    {
        $title = "Chi tiết phòng";
        $validatedData = $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để bình luận.');
        }
        $data = [
            'booking_id' => $request->id,
            'user_id' => $user->id,
            'room_id' => $id,
            'comment' => $validatedData['comment'],
            'rating' => $validatedData['rating']
        ];
        Review::create($data);
        return redirect()->route('client.review', ['id' => $request->id])
            ->with('success', 'Bình luận của bạn đã được gửi.')
            ->with('title', $title);
    }
}
