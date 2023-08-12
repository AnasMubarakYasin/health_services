<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Administrator;
use Illuminate\Support\Arr;

class AdministratorController extends Controller
{
    public function login_show()
    {
        return view('pages.administrator.login');
    }
    public function login_perfom(LoginRequest $request)
    {
        $data = $request->validated();
        if (auth()->attempt(Arr::only($data, ['name', 'password']), isset($data['remember']))) {
            session()->regenerate();

            return to_route('web.administrator.dashboard');
        } else {
            return back()->withErrors(['name' => ['username not exists.'], 'password' => ['password not exists.']]);
        }
    }
    public function logout_perfom()
    {
        $template = session()->get('template', config('dynamic.application.template'));
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->put('template', $template);

        return to_route('web.administrator.login_show');
    }

    public function register_show()
    {
        return view('pages.administrator.register');
    }
    public function register_perfom(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = Administrator::query()->where('name', $data['name'])->first();
        if ($user) {
            return back()->withErrors(['name' => ['username already exists.']]);
        }
        $user = Administrator::query()->where('email', $data['email'])->first();
        if ($user) {
            return back()->withErrors(['email' => ['email already exists.']]);
        }
        $user = Administrator::create($data);
        auth()->login($user);
        session()->regenerate();

        return to_route('web.administrator.dashboard');
    }
}
