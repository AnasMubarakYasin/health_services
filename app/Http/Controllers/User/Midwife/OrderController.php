<?php

namespace App\Http\Controllers\User\Midwife;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderFinished;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function api_done(Order $order)
    {
        $order->update(['status' => 'finished']);
        $order->patient->notifyNow(new OrderFinished($order));
        $order->midwife->notifyNow(new OrderFinished($order));

        info("Orders finish", [
            'order' => $order->toArray(),
        ]);

        return back();
    }
}
