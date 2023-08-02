<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create(StoreScheduleRequest $request)
    {
        $this->authorize('create', Schedule::class);
        $data = $request->validated();
        Schedule::create($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function update(StoreScheduleRequest $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        $data = $request->validated();
        $schedule->update($data);
        return redirect()->intended($request->input('_view_any'));
    }
    public function delete(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);
        $schedule->delete();
        return back();
    }
    public function delete_any(Request $request)
    {
        $this->authorize('delete_any', Schedule::class);
        if ($request->input('all')) {
            Schedule::truncate();
        } else {
            Schedule::destroy($request->input('id', []));
        }
        return back();
    }
    public function restore(Schedule $schedule)
    {
        $this->authorize('restore', $schedule);
        return abort(501);
    }
}
