<?php

namespace App\Http\Controllers\User\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Administrator;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Support\Facades\Blade;
use stdClass;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $visitors = new stdClass();
        $visitors->name = "visitor today";
        $visitors->icon = Blade::render('<x-icons.user_group stroke="2" />');
        $visitors->count = 100;
        $visitors->subcount = "200 yesterday";

        $service = Service::statable()->init(
            name: "service",
            icon: Blade::render('<x-icons.square stroke="2" />'),
        )->resourcing();
        $schedule = Schedule::statable()->init(
            name: "schedule",
            icon: Blade::render('<x-icons.calendar stroke="2" />'),
        )->resourcing();
        $order = Order::statable()->init(
            name: "order",
            icon: Blade::render('<x-icons.shop_bag stroke="2" />'),
        )->resourcing();

        $patient = Patient::statable()->init(
            name: "patient",
            icon: Blade::render('<x-icons.users stroke="2" />'),
        )->resourcing();
        $midwife = Midwife::statable()->init(
            name: "midwife",
            icon: Blade::render('<x-icons.users stroke="2" />'),
        )->resourcing();
        $administrator = Administrator::statable()->init(
            name: "administrator",
            icon: Blade::render('<x-icons.users stroke="2" />'),
        )->resourcing();
        return view('pages.administrator.dashboard', [
            'visitors' => $visitors,

            'service' => $service,
            'schedule' => $schedule,
            'order' => $order,

            'patient' => $patient,
            'midwife' => $midwife,
            'administrator' => $administrator,
        ]);
    }
    public function profile()
    {
        $resource = Administrator::formable()->from_update(
            model: auth()->user(),
            fields: ['name', 'telp', 'email'],
        );
        $resource->web_view_any = function () {
            return route('web.administrator.users.administrator.index');
        };
        return view('pages.administrator.profile', ['resource' => $resource]);
    }
    public function change_profile(ChangeProfileRequest $request)
    {
        /** @var User */
        $user = auth()->user();
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
        return view('pages.administrator.notification');
    }
    public function offline()
    {
        return view('pages.administrator.offline');
    }
    public function empty()
    {
        return view('pages.administrator.empty');
    }
}
