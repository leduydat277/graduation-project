<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationsController
{
    public function showNotifications()
    {
        $notifications = Notification::where('user_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $notifications->map(function ($notification) {
            $messageData = json_decode($notification->message);
            $booking = Booking::where('id', $messageData->booking_id)->first();
            if (!$booking) {
                Notification::where('message', $notification->message)->delete();
            };
            return [
                "id" => $notification->id,
                'title' => $notification->title,
                'date' => $messageData->date,
                'message' => $messageData->message,
                'booking_id' => $messageData->booking_id,
                "is_read" => $notification->is_read,
            ];
        });

        return response()->json([
            "type" => "success",
            "data" => $data
        ], 200);
    }

    public function deleteNotifications(Request $request)
    {
        $ids = $request->input('notification_ids');

        if (is_array($ids) && !empty($ids)) {
            Notification::whereIn('id', $ids)->delete();
            return response()->json(['type' => 'success', 'message' => 'Thông báo đã được xóa.']);
        }

        return response()->json(['type' => 'error', 'message' => 'Không có thông báo để xóa.']);
    }

    public function readNotifications(Request $request)
    {
        $ids = $request->input('notification_ids');
        $timestamp = Carbon::now('Asia/Ho_Chi_Minh');
        $formattedDate = $timestamp->format('Y-m-d H:i:s');

        if (is_array($ids) && !empty($ids)) {
            Notification::whereIn('id', $ids)
                ->update(['is_read' => 1, 'read_at' => $formattedDate]);

            return response()->json(['type' => 'success', 'message' => 'Thông báo đã được đọc.']);
        }

        return response()->json(['type' => 'error', 'message' => 'Không có thông báo để đọc.']);
    }
}
