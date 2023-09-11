<?php

namespace App\Http\Controllers\User\Patient;

use App\Dynamic\Panel\Panel;
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

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $midwifes = Midwife::all();
        $order = null;
        if (auth('patient')->user()) {
            $order = Order::first_unfinish_by_patient(auth('patient')->user());
        }

        return view('pages.patient.landing', [
            'panel' => $this->create_panel(),
            'services' => $services,
            'midwifes' => $midwifes,
            'order' => $order,
        ]);
    }
    public function history()
    {
        $orders = Order::get_by_patient(auth('patient')->user());
        return view('pages.patient.landing_history', [
            'panel' => $this->create_panel(),
            'orders' => $orders,
        ]);
    }
    public function profile()
    {
        $resource = Patient::formable()->from_update(
            model: auth('patient')->user(),
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
        $user = auth('patient')->user();
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
        $user = auth('patient')->user();
        if (!auth('patient')->validate(['name' => $user->name, 'password' => $data['password_current']])) {
            return back()->withErrors(["password_current" => ['password mismatch']]);
        }
        if ($data['password_current'] == $data['password']) {
            return back()->withErrors(["password" => ['new password cannot same with current password']]);
        }
        $user->password = $data['password'];
        $user->save();

        return back();
    }

    protected function create_panel() {
        /** @var ?Patient */
        $user = auth('patient')->user();
        /** @var ?Patient */
        $panel = null;
        if ($user) {
            $panel = Panel::create($user::class);
            $panel->user = $user;
            $panel->locale = session("locale_$user->id", app()->getLocale());
            $panel->template = session('template', config('dynamic.application.template'));
            $panel->preference = session("preference_$user->id", new \stdClass());
            $panel->token = $user->createToken('generic')->plainTextToken;
        }
        return $panel;
    }
}
