<?php

namespace App\Jobs;

use App\Models\Order;
use App\Notifications\OrderCome as NotificationsOrderCome;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCome implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order_today = Order::get_unfinish_today();
        $order_tomorrow = Order::get_unfinish_tomorrow();
        $order_yesterday = Order::get_unfinish_yesterday();
        info("Run OrderCome Job", [
            'today' => count($order_today),
            'tomorrow' => count($order_tomorrow),
            'yesterday' => count($order_yesterday),
        ]);
        foreach ($order_today as $key => $order) {
            $order->patient->notifyNow(new NotificationsOrderCome($order));
            $order->midwife->notifyNow(new NotificationsOrderCome($order));
        }
        foreach ($order_tomorrow as $key => $order) {
            $order->patient->notifyNow(new NotificationsOrderCome($order));
            $order->midwife->notifyNow(new NotificationsOrderCome($order));
        }
        foreach ($order_yesterday as $key => $order) {
            $order->status = "finished";
            $order->confirm = "yes";
            $order->update();
        }
    }
}
