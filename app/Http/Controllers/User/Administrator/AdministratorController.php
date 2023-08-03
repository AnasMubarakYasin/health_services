<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $resource = Administrator::tableable()->from_request(
            request: request(),
            columns: [
                'photo',
                "name",
                "fullname",
                'address',
                "telp",
                "email",
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.users.administrator.create');
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.users.administrator.update', ['administrator' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.administrator.delete', ['administrator' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.administrator.delete_any');
        };
        return view('pages.administrator.administrator.index', ['resource' => $resource]);
    }
    public function create()
    {
        $resource = Administrator::formable()->from_create(
            fields: [
                'photo',
                "name",
                "fullname",
                'address',
                "telp",
                "email",
                'password',
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.administrator.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.users.administrator.index');
        };
        return view('pages.administrator.administrator.create', ['resource' => $resource]);
    }
    public function update(Administrator $administrator)
    {
        $resource = Administrator::formable()->from_update(
            model: $administrator,
            fields: [
                'photo',
                "name",
                "fullname",
                'address',
                "telp",
                "email",
                'password',
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.administrator.update', ['administrator' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.users.administrator.index');
        };
        return view('pages.administrator.administrator.update', ['resource' => $resource]);
    }

    public function service_index()
    {
        $resource = Service::tableable()->from_request(
            request: request(),
            columns: [
                "name",
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.service.create');
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.service.update', ['service' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.service.delete', ['service' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.service.delete_any');
        };
        return view('pages.administrator.service.index', ['resource' => $resource]);
    }
    public function service_create()
    {
        $resource = Service::formable()->from_create(
            fields: [
                "name",
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.service.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.service.index');
        };
        return view('pages.administrator.service.create', ['resource' => $resource]);
    }
    public function service_update(Service $service)
    {
        $resource = Service::formable()->from_update(
            model: $service,
            fields: [
                "name",
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.service.update', ['service' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.service.index');
        };
        return view('pages.administrator.service.update', ['resource' => $resource]);
    }

    public function schedule_index()
    {
        $resource = Schedule::tableable()->from_request(
            request: request(),
            columns: [
                "day",
                "midwive"
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.schedule.create');
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.schedule.update', ['schedule' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.schedule.delete', ['schedule' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.schedule.delete_any');
        };
        return view('pages.administrator.schedule.index', ['resource' => $resource]);
    }
    public function schedule_create()
    {
        $resource = Schedule::formable()->from_create(
            fields: [
                "day",
                "midwive"
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.schedule.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.schedule.index');
        };
        return view('pages.administrator.schedule.create', ['resource' => $resource]);
    }
    public function schedule_update(Schedule $schedule)
    {
        $resource = Schedule::formable()->from_update(
            model: $schedule,
            fields: [
                "day",
                "midwive"
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.schedule.update', ['schedule' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.schedule.index');
        };
        return view('pages.administrator.schedule.update', ['resource' => $resource]);
    }

    public function order_index()
    {
        $resource = Order::tableable()->from_request(
            request: request(),
            columns: [
                "status",
                "schedule",
                "start_at",
                "end_at",
                "patient",
                "service"
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.order.create');
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
        return view('pages.administrator.order.index', ['resource' => $resource]);
    }
    public function order_create()
    {
        $resource = Order::formable()->from_create(
            fields: [
                "status",
                "schedule",
                "start_at",
                "end_at",
                "patient",
                "service"
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
    public function order_update(Order $order)
    {
        $resource = Order::formable()->from_update(
            model: $order,
            fields: [
                "status",
                "schedule",
                "start_at",
                "end_at",
                "patient",
                "service"
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
