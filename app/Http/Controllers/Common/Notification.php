<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class Notification extends Controller
{
    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        if (isset($notification->data['action'])) {
            return redirect($notification->data['action']);
        }

        return back();
    }
    public function mark(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return back();
    }
    public function delete(DatabaseNotification $notification)
    {
        $notification->delete();

        return back();
    }
    public function mark_all()
    {
        /** @var User */
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();

        return back();
    }
    public function delete_all()
    {
        /** @var User */
        $user = auth()->user();
        $user->notifications()->delete();

        return back();
    }
}
