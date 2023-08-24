<?php

namespace App\Http\Controllers\User\Midwife;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Schedule\StoreRequest as CreateRequest;
use App\Http\Requests\Resource\Schedule\UpdateRequest;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function web_create()
    {
        $resource = Schedule::formable()->from_create(
            fields: [
                "active",
                "day",
                "started_at",
                "ended_at",
                'midwife',
            ],
            hidden: [
                'midwife',
            ],
        );
        $resource->api_create = function () {
            return route('web.midwife.schedule.handle.create');
        };
        $resource->model->midwife_id = auth()->user()->id;
        return view('pages.midwife.schedule', [
            'resource' => $resource,
        ]);
    }
    public function web_update(Schedule $schedule)
    {
        $resource = Schedule::formable()->from_update(
            model: $schedule,
            fields: [
                "active",
                "day",
                "started_at",
                "ended_at",
                'midwife',
            ],
            hidden: [
                'midwife',
            ],
        );
        $resource->api_update = function ($item) {
            return route('web.midwife.schedule.handle.update', ['schedule' => $item]);
        };
        return view('pages.midwife.schedule', [
            'resource' => $resource,
        ]);
    }

    public function api_create(CreateRequest $request)
    {
        Schedule::create($request->validated());
        return to_route('web.midwife.dashboard');
    }
    public function api_update(UpdateRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());
        return to_route('web.midwife.dashboard');
    }
    public function api_delete(Schedule $schedule)
    {
        $schedule->delete();
        return to_route('web.midwife.dashboard');
    }
}
