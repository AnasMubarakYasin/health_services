<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Patient;
use Illuminate\Support\Arr;

class PatientController extends Controller
{
    public function login_show()
    {
        if (request()->query('want_order')) {
            session()->put('want_order', request()->query('want_order'));
        } else {
            session()->remove('want_order');
        }
        return view('pages.patient.login');
    }
    public function login_perfom(LoginRequest $request)
    {
        $data = $request->validated();
        $user = Patient::query()->where('name', $data['name'])->first();
        if (!$user) {
            return back()->withErrors(['name' => ['username not exists.']]);
        }
        if ($user->password != $data['password']) {
            return back()->withErrors(['name' => ['username is wrong.'], 'password' => ['password is wrong.']]);
        }
        auth()->login($user, isset($data['remember']));
        session()->regenerate();

        if (session('want_order')) {
            $midwife = session('want_order');
            session()->remove('want_order');
            return to_route('web.patient.order.midwife', ['midwife' => $midwife]);
        }
        return to_route('web.patient.landing');
    }
    public function logout_perfom()
    {
        $template = session()->get('template', config('dynamic.application.template'));
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->put('template', $template);

        return to_route('web.patient.login_show');
    }

    public function register_show()
    {
        if (request()->query('want_order')) {
            session()->put('want_order', request()->query('want_order'));
        } else {
            session()->remove('want_order');
        }
        return view('pages.patient.register');
    }
    public function register_perfom(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = Patient::query()->where('name', $data['name'])->first();
        if ($user) {
            return back()->withErrors(['name' => ['username already exists.']]);
        }
        $user = Patient::query()->where('email', $data['email'])->first();
        if ($user) {
            return back()->withErrors(['email' => ['email already exists.']]);
        }
        $user = Patient::create($data);
        auth()->login($user);
        session()->regenerate();

        if (session('want_order')) {
            $midwife = session('want_order');
            session()->remove('want_order');
            return to_route('web.patient.order.midwife', ['midwife' => $midwife]);
        }
        return to_route('web.patient.landing');
    }
}
