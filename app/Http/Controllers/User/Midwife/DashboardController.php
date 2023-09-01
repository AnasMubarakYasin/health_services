<?php

namespace App\Http\Controllers\User\Midwife;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Midwife\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $schedules = Schedule::get_by_midwife($user);
        $orders = Order::get_unfinish_by_midwife($user);

        $schedules_coll = collect();
        foreach ($schedules as $key => $schedule) {
            if ($schedules_coll->some('day', '==', $schedule->day)) {
                $item = $schedules_coll->sole('day', '==', $schedule->day);
                $key = $schedules_coll->search($item);
                array_push($item['times'], $schedule->started_at . ' - ' . $schedule->ended_at);
                array_push($item['ids'], $schedule->id);
                array_push($item['active'], $schedule->active);
                $schedules_coll->put($key, $item);
            } else {
                $schedules_coll->push([
                    'day' => $schedule->day,
                    'times' => [$schedule->started_at . ' - ' . $schedule->ended_at],
                    'ids' => [$schedule->id],
                    'active' => [$schedule->active],
                ]);
            }
        }

        return view('pages.midwife.dashboard', [
            'schedules' => $schedules,
            'schedules_coll' => $schedules_coll,
            'orders' => $orders,
        ]);
    }
    public function history()
    {
        $orders = Order::get_by_midwife(auth()->user());
        return view('pages.midwife.history', [
            'orders' => $orders,
        ]);
    }
    public function history_detail(Order $order)
    {
        $orders = Order::get_by_midwife(auth()->user());
        return view('pages.midwife.history_detail', [
            'order' => $order,
        ]);
    }

    public function profile()
    {
        $resource = Midwife::formable()->from_update(
            model: auth()->user(),
            fields: [
                'name',
                'password',
                'photo',
                'fullname',
                "email",
                'telp',
                'srt',
            ],
        );
        return view('pages.midwife.profile', ['resource' => $resource]);
    }
    public function change_profile(Request $request)
    {
        /** @var Midwife */
        $user = auth()->user();
        $user->update($request->only([
            'name',
            'password',
            'photo',
            'fullname',
            "email",
            'telp',
            'srt',
        ]));
        return back();
    }
    public function change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        /** @var User */
        $user = auth()->user();
        if (!auth()->validate(['name' => $user->name, 'password' => $data['password_current']])) {
            return back()->withErrors(["password_current" => ['password mismatch']]);
        }
        if ($data['password_current'] == $data['password']) {
            return back()->withErrors(["password" => ['new password cannot same with current password']]);
        }
        $user->password = $data['password'];
        $user->save();

        return back();
    }
    public function notification()
    {
        return view('pages.midwife.notification');
    }
    public function offline()
    {
        return view('pages.midwife.offline');
    }
    public function settings()
    {
        /** @var Midwife */
        $user = auth()->user();
        return view('pages.midwife.settings', []);
    }
    public function empty()
    {
        return view('pages.midwife.empty');
    }
}
