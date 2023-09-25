<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $resource = Service::tableable();
        $resource->options['filter_by_column'] = false;
        $resource->options['selectable'] = false;
        $resource->from_request(
            request: request(),
            columns: [
                "name",
                'img',
                'description',
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
    public function create()
    {
        $resource = Service::formable()->from_create(
            fields: [
                "name",
                'img',
                'description',
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
    public function update(Service $service)
    {
        $resource = Service::formable()->from_update(
            model: $service,
            fields: [
                "name",
                'img',
                'description',
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
}
