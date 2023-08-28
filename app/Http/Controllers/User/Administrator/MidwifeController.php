<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Midwife;
use Illuminate\Http\Request;

class MidwifeController extends Controller
{
    public function index()
    {
        $resource = Midwife::tableable()->from_request(
            request: request(),
            columns: [
                "name",
                'password',
                'photo',
                "fullname",
                "email",
                "telp",
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.users.midwife.create');
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.users.midwife.update', ['midwife' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.midwife.delete', ['midwife' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.midwife.delete_any');
        };
        return view('pages.administrator.midwife.index', ['resource' => $resource]);
    }
    public function create()
    {
        $resource = Midwife::formable()->from_create(
            fields: [
                "name",
                'password',
                'photo',
                "fullname",
                "email",
                "telp",
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.midwife.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.users.midwife.index');
        };
        return view('pages.administrator.midwife.create', ['resource' => $resource]);
    }
    public function update(Midwife $midwife)
    {
        $resource = Midwife::formable()->from_update(
            model: $midwife,
            fields: [
                "name",
                'password',
                'photo',
                "fullname",
                "email",
                "telp",
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.midwife.update', ['midwife' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.users.midwife.index');
        };
        return view('pages.administrator.midwife.update', ['resource' => $resource]);
    }
}
