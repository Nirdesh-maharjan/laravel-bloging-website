<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $notifications = $user->notifications()->latest()->take(10)->get();
        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'unreadCount' => $unreadCount,
            'notifications' => $notifications,
        ]);
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['ok' => true]);
    }

    public function markRead($id)
    {
        $n = auth()->user()->notifications()->where('id', $id)->firstOrFail();
        $n->markAsRead();

        return response()->json(['ok' => true]);
    }
}
