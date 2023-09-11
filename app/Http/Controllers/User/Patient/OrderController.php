<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\CreateOrderMidwifeRequest;
use App\Http\Requests\Patient\OrderRequest;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Service;
use App\Notifications\OrderScheduled;

class OrderController extends Controller
{
    public function web_order()
    {
        $services = Service::all();
        $midwifes = Midwife::all();
        $schedules = Schedule::get_active();
        $orders = Order::get_unfinish();
        return view('pages.patient.order', [
            'services' => $services,
            'midwifes' => $midwifes,
            'schedules' => $schedules,
            'orders' => $orders,
        ]);
    }
    public function web_order_detail(Order $order)
    {
        return view('pages.patient.order_detail', [
            'order' => $order,
        ]);
    }
    public function api_order(OrderRequest $request)
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
            'midwife_id' =>  $data['midwife'],
            'service_id' =>  $data['service'],
        ]);
        $order->patient->notifyNow(new OrderScheduled($order));
        $order->midwife->notifyNow(new OrderScheduled($order));
        return to_route('web.patient.dashboard');
    }

    public function web_order_midwife(Midwife $midwife)
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
    public function api_order_midwife(CreateOrderMidwifeRequest $request, Midwife $midwife)
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
        $order->patient->notifyNow(new OrderScheduled($order));
        $order->midwife->notifyNow(new OrderScheduled($order));
        return to_route('web.patient.landing');
    }
}
