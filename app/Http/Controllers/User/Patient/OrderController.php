<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\CreateOrderMidwifeRequest;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Service;
use App\Notifications\OrderComingsoon;

class OrderController extends Controller
{
    public function web_order(Midwife $midwife)
    {
        $services = Service::all();
        $orders = Order::get_unfinish_by_midwife($midwife);
        return view('pages.patient.order_midwife', [
            'midwife' => $midwife,
            'schedules' => $midwife->active_schedules(),
            'services' => $services,
            'orders' => $orders,
        ]);
    }
    public function api_order(CreateOrderMidwifeRequest $request, Midwife $midwife)
    {
        $unfinish_order = Order::first_unfinish_by_patient(auth()->user());
        if ($unfinish_order) {
            return back()->withErrors(['api' => 'user have unfinish order']);
        }
        $data = $request->validated();
        $order = Order::create([
            'status' => 'scheduled',
            'schedule' => date('Y-m-d', strtotime(str_replace('/', '-', $data['date']))),
            'schedule_start' => "{$data['time']}:00:00",
            'schedule_end' => "{$data['time']}:55:00",
            'location_name' => $data['location'],
            'location_coordinates' => $data['position'],
            'complaint' => isset($data['complaint']) ? $data['complaint'] : '',
            'patient_id' => auth()->user()->id,
            'midwife_id' =>  $midwife->id,
            'service_id' =>  $data['service'],
        ]);
        $order->patient->notifyNow(new OrderComingsoon($order));
        $order->midwife->notifyNow(new OrderComingsoon($order));
        return to_route('web.patient.dashboard');
    }
}
