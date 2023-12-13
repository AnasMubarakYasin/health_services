<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\OrderLimit;
use Illuminate\Http\Request;

class OrderLimitController extends Controller
{
    public function index()
    {
        $resource = OrderLimit::tableable();
        $resource->options['filter_by_column'] = false;
        $resource->options['selectable'] = false;
        $resource->from_request(
            request: request(),
            columns: [
                'limit',
                'date',
                'midwife',
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.order_limit.create');
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.order_limit.update', ['order_limit' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.order_limit.delete', ['order_limit' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.order_limit.delete_any');
        };
        $resource->route_relation = function ($definition) {
            return match ($definition->name) {
                'midwife' => route('web.administrator.users.midwife.index'),
                default => throw new \Error("unknown name of $definition->name")
            };
        };
        return view('pages.administrator.order_limit.index', ['resource' => $resource]);
    }
    public function create()
    {
        $resource = OrderLimit::formable()->from_create(
            fields: [
                'limit',
                'date',
                'midwife',
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.order_limit.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.order_limit.index');
        };
        return view('pages.administrator.order_limit.create', ['resource' => $resource]);
    }
    public function update(OrderLimit $order_limit)
    {
        $resource = OrderLimit::formable()->from_update(
            model: $order_limit,
            fields: [
                'limit',
                'date',
                'midwife',
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.order_limit.update', ['order_limit' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.order_limit.index');
        };
        return view('pages.administrator.order_limit.update', ['resource' => $resource]);
    }
}
