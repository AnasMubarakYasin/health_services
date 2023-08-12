<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\CreateOrderRequest;
use App\Http\Requests\Resource\Patient\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $services = Service::all();
        $order = Order::first_unfinish_patient(auth()->user());

        return view('pages.patient.dashboard', [
            'services' => $services,
            'order' => $order,
        ]);
    }
    public function show_order(Service $service)
    {
        $midwives = Midwife::with('schedules')->get();

        $times = Arr::mapWithKeys(range(0, 12), function ($key, $val) {
            $time = $val + 8;
            $hour = $time < 10 ? '0' . $time : $time;
            return [$time . '' => "$hour:00 - $hour:55"];
        });
        $rest_times = ['12', '16', '17', '18'];
        $work_times = Arr::except($times, $rest_times);
        return view('pages.patient.order', [
            'service' => $service,
            'midwives' => $midwives,
            'work_times' => $work_times,
        ]);
    }
    public function perform_order(CreateOrderRequest $request, Service $service)
    {
        $unfinish_order = Order::first_unfinish_patient(auth()->user());
        if ($unfinish_order) {
            return back()->withErrors(['api' => 'user have unfinish order']);
        }
        $data = $request->validated();
        $order = Order::create([
            'status' => 'scheduled',
            'schedule' => $data['date'],
            'schedule_start' => "{$data['time']}:00:00",
            'schedule_end' => "{$data['time']}:55:00",
            'location_name' => $data['location'],
            'location_coordinates' => $data['position'],
            'patient_id' => auth()->user()->id,
            'midwife_id' =>  $data['midwife'],
            'service_id' => $service->id,
        ]);
        return to_route('web.patient.dashboard');
    }
    public function history()
    {
        $orders = Order::get_patient(auth()->user());
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
                "telp",
                "age",
                "weight",
                "height",
            ],
        );
        return view('pages.patient.profile', ['resource' => $resource]);
    }
    public function change_profile(UpdateRequest $request)
    {
        /** @var Patient */
        $user = auth()->user();
        $user->update($request->validated());
        return to_route('web.patient.dashboard');
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
