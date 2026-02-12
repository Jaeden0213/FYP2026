<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('notification', compact('notifications'));
    }

    public function markAsRead(Request $request, $id)
    {
        $n = Notification::where('notification_id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $n->sent_status = true;
        $n->save();

        return response()->json(['ok' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $n = Notification::where('notification_id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $n->delete();

        return response()->json(['ok' => true]);
    }
}
