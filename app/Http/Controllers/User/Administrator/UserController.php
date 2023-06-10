<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function administrator_list()
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
        $resource->route_store = function () {
            return route('web.administrator.users.administrator.create');
        };
        $resource->route_edit = function ($item) {
            return route('web.administrator.users.administrator.update', ['administrator' => $item]);
        };
        $resource->route_delete = function ($item) {
            return route('web.resource.administrator.delete', ['administrator' => $item]);
        };
        $resource->route_delete_any = function ($item) {
            return route('web.resource.administrator.delete_any');
        };
        return view('pages.administrator.administrator.list', ['resource' => $resource]);
    }
    public function administrator_create()
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
        $resource->route_create = function () {
            return route('web.resource.administrator.create');
        };
        $resource->route_view_any = function ($item) {
            return route('web.administrator.users.administrator.list');
        };
        return view('pages.administrator.administrator.create', ['resource' => $resource]);
    }
    public function administrator_update(Administrator $administrator)
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
        $resource->route_update = function ($item) {
            return route('web.resource.administrator.update', ['administrator' => $item]);
        };
        $resource->route_view_any = function ($item) {
            return route('web.administrator.users.administrator.list');
        };
        return view('pages.administrator.administrator.update', ['resource' => $resource]);
    }
}
