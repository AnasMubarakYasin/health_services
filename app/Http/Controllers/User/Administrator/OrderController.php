<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $resource = Order::tableable();
        $resource->options['filter_by_column'] = false;
        $resource->options['selectable'] = false;
        $resource->from_request(
            request: request(),
            columns: [
                'status',
                'confirm',
                'schedule',
                'schedule_start',
                'schedule_end',
                'location_name',
                'location_coordinates',
                'complaint',
                'patient',
                'midwife',
                'service',
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            // return route('web.administrator.order.create');
            return "";
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.order.update', ['order' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.order.delete', ['order' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.order.delete_any');
        };
        $resource->route_relation = function ($definition) {
            return match ($definition->name) {
                'patient' => route('web.administrator.users.patient.index'),
                'midwife' => route('web.administrator.users.midwife.index'),
                'service' => route('web.administrator.service.index'),
                default => throw new \Error("unknown name of $definition->name")
            };
        };
        return view('pages.administrator.order.index', ['resource' => $resource]);
    }
    public function create()
    {
        $resource = Order::formable()->from_create(
            fields: [
                'status',
                'confirm',
                'schedule',
                'schedule_start',
                'schedule_end',
                'location_name',
                'location_coordinates',
                'complaint',
                'patient',
                'midwife',
                'service',
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.order.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.order.index');
        };
        return view('pages.administrator.order.create', ['resource' => $resource]);
    }
    public function update(Order $order)
    {
        $resource = Order::formable()->from_update(
            model: $order,
            fields: [
                'status',
                'confirm',
                'schedule',
                'schedule_start',
                'schedule_end',
                'location_name',
                'location_coordinates',
                'complaint',
                'patient',
                'midwife',
                'service',
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.order.update', ['order' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.order.index');
        };
        return view('pages.administrator.order.update', ['resource' => $resource]);
    }
}
