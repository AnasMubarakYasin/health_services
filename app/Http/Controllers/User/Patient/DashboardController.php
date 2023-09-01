<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\CreateOrderMidwifeRequest;
use App\Http\Requests\Patient\CreateOrderRequest;
use App\Http\Requests\Resource\Patient\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use App\Notifications\OrderComingsoon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function landing()
    {
        /** @var ?Patient */
        $user = auth('patient')->user();
        $services = Service::all();
        $midwifes = Midwife::all();

        return view('pages.patient.landing', [
            'user' => $user,
            'services' => $services,
            'midwifes' => $midwifes,
        ]);
    }
    public function dashboard()
    {
        $services = Service::all();
        $midwifes = Midwife::all();
        $order = Order::first_unfinish_by_patient(auth()->user());

        return view('pages.patient.dashboard', [
            'services' => $services,
            'midwifes' => $midwifes,
            'order' => $order,
        ]);
    }
    public function history()
    {
        $orders = Order::get_by_patient(auth()->user());
        return view('pages.patient.history', [
            'orders' => $orders,
        ]);
    }

    public function profile()
    {
        $resource = Patient::formable()->from_update(
            model: auth()->user(),
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
        return view('pages.patient.profile', ['resource' => $resource]);
    }
    public function change_profile(Request $request)
    {
        /** @var Patient */
        $user = auth()->user();
        $user->update($request->only([
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
        return view('pages.patient.notification');
    }
    public function offline()
    {
        return view('pages.patient.offline');
    }
    public function settings()
    {
        /** @var Patient */
        $user = auth()->user();
        return view('pages.patient.settings', []);
    }
    public function empty()
    {
        return view('pages.patient.empty');
    }
}
