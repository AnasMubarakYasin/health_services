<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $resource = Schedule::tableable();
        $resource->options['filter_by_column'] = false;
        $resource->options['selectable'] = false;
        $resource->from_request(
            request: request(),
            columns: [
                "day",
                "started_at",
                "ended_at",
                "active",
                "midwife"
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
        $resource->route_relation = function ($definition) {
            return match ($definition->name) {
                'midwife' => route('web.administrator.users.midwife.index'),
                default => throw new \Error("unknown name of $definition->name")
            };
        };
        return view('pages.administrator.schedule.index', ['resource' => $resource]);
    }
    public function create()
    {
        $resource = Schedule::formable()->from_create(
            fields: [
                "active",
                "day",
                "started_at",
                "ended_at",
                "midwife"
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
    public function update(Schedule $schedule)
    {
        $resource = Schedule::formable()->from_update(
            model: $schedule,
            fields: [
                "active",
                "day",
                "started_at",
                "ended_at",
                "midwife"
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
}
