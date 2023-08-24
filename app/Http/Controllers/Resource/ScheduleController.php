<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Schedule\StoreRequest;
use App\Http\Requests\Resource\Schedule\UpdateRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create(StoreRequest $request)
    {
        $this->authorize('create', Schedule::class);
        $data = $request->validated();
        Schedule::create($data);
        return redirect($request->input('_view_any'));
    }
    public function update(UpdateRequest $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);
        $data = $request->validated();
        $schedule->update($data);
        dd($request->input('_view_any'));
        return redirect($request->input('_view_any'));
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
