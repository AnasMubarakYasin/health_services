<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
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
    public function mark_all(string $id)
    {
        DatabaseNotification::where("notifiable_id", $id)->where('read_at', null)->update(['read_at' => now()]);

        return back();
    }
    public function delete_all(string $id)
    {
        DatabaseNotification::where("notifiable_id", $id)->whereNot('read_at', null)->delete();

        return back();
    }
}
