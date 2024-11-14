<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getUnreadNotifications()
    {
        $userId = Auth::id();

        $notifications = Notification::whereNull('read_at')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['read_at' => now()]);

        if ($notification->type === 'reservasi') {
            return redirect()->route('admin.reservasi.index');
        } else {
            return redirect()->route('admin.pesanan.index');
        }
    }

    public function markAllAsRead()
    {
        $userId = Auth::id();

        Notification::whereNull('read_at')
            ->where('user_id', $userId)
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'All notifications marked as read']);
    }
}
