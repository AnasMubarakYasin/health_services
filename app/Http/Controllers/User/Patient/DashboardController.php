<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('pages.patient.dashboard', []);
    }
    public function profile()
    {
        $resource = Patient::formable()->from_update(
            model: auth()->user(),
            fields: ['photo', 'name', 'telp', 'email'],
        );
        return view('pages.patient.profile', ['resource' => $resource]);
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
        return view('pages.patient.notification');
    }
    public function offline()
    {
        return view('pages.patient.offline');
    }
    public function empty()
    {
        return view('pages.patient.empty');
    }
}
