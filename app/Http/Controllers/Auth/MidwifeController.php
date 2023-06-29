<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Midwife;
use Illuminate\Support\Arr;

class MidwifeController extends Controller
{
    public function login_show()
    {
        return view('pages.midwife.login');
    }
    public function login_perfom(LoginRequest $request)
    {
        $data = $request->validated();
        $user = Midwife::query()->where('name', $data['name'])->first();

        if (!$user) {
            return back()->withErrors(['name' => ['username not exists.']]);
        }
        if ($user->password != $data['password']) {
            return back()->withErrors(['name' => ['username is wrong.'], 'password' => ['password is wrong.']]);
        }
        auth()->login($user, isset($data['remember']));
        session()->regenerate();
        return to_route('web.midwife.dashboard');
    }
    public function logout_perfom()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return to_route('web.midwife.login_show');
    }

    public function register_show()
    {
        return view('pages.midwife.register');
    }
    public function register_perfom(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = Midwife::query()->where('name', $data['name'])->first();
        if ($user) {
            return back()->withErrors(['name' => ['username already exists.']]);
        }
        $user = Midwife::query()->where('email', $data['email'])->first();
        if ($user) {
            return back()->withErrors(['email' => ['email already exists.']]);
        }
        $user = Midwife::create($data);
        auth()->login($user);
        session()->regenerate();

        return to_route('web.midwife.dashboard');
    }
}
