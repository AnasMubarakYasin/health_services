<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $resource = Patient::tableable();
        $resource->options['filter_by_column'] = false;
        $resource->options['selectable'] = false;
        $resource->from_request(
            request: request(),
            columns: [
                "name",
                'password',
                'photo',
                "fullname",
                "email",
                "telp",
                "age",
                "weight",
                "height",
                'date_of_birth',
                'place_of_birth',
                'gender',
            ],
            pagination: ['per' => 5, 'num' => 1],
        );
        $resource->web_create = function () {
            return route('web.administrator.users.patient.create');
        };
        $resource->web_update = function ($item) {
            return route('web.administrator.users.patient.update', ['patient' => $item]);
        };
        $resource->api_delete = function ($item) {
            return route('web.resource.patient.delete', ['patient' => $item]);
        };
        $resource->api_delete_any = function () {
            return route('web.resource.patient.delete_any');
        };
        return view('pages.administrator.patient.index', ['resource' => $resource]);
    }
    public function create()
    {
        $resource = Patient::formable()->from_create(
            fields: [
                "name",
                'password',
                'photo',
                "fullname",
                "email",
                "telp",
                "age",
                "weight",
                "height",
                'date_of_birth',
                'place_of_birth',
                'gender',
            ],
        );
        $resource->api_create = function () {
            return route('web.resource.patient.create');
        };
        $resource->web_view_any = function () {
            return route('web.administrator.users.patient.index');
        };
        return view('pages.administrator.patient.create', ['resource' => $resource]);
    }
    public function update(Patient $patient)
    {
        $resource = Patient::formable()->from_update(
            model: $patient,
            fields: [
                "name",
                'password',
                'photo',
                "fullname",
                "email",
                "telp",
                "age",
                "weight",
                "height",
                'date_of_birth',
                'place_of_birth',
                'gender',
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.resource.patient.update', ['patient' => $item]);
        };
        $resource->web_view_any = function () {
            return route('web.administrator.users.patient.index');
        };
        return view('pages.administrator.patient.update', ['resource' => $resource]);
    }
}
