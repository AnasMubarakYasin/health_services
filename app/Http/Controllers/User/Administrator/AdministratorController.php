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
        $resource = Administrator::tableable();
        $resource->options['filter_by_column'] = false;
        $resource->options['selectable'] = false;
        $resource->from_request(
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
}
