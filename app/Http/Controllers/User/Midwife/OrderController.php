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
        $model = null;
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $model = $order->pregnancy_examination;
        } else if ($order->service->name == 'pelayanan KB') {
            $model = $order->family_planning;
        } else if ($order->service->name == 'tindik telinga') {
            $model = $order->ear_pierching;
        } else if ($order->service->name == 'perawatan bayi baru lahir') {
            $model = $order->newborn_cares->toArray();
        } else if ($order->service->name == 'pelayanan kesehatan masa nifas') {
            $model = $order->postpartum_healths->toArray();
        }

        if (!$model) {
            return to_route('web.midwife.record.edit', ['order' => $order]);
        }

        $order->update(['status' => 'finished']);
        $order->patient->notifyNow(new OrderFinished($order));
        $order->midwife->notifyNow(new OrderFinished($order));

        info("Orders finish", [
            'order' => $order->toArray(),
        ]);

        return back();
    }
}
