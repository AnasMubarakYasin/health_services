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
use App\Models\PregnancyExamination;
use App\Models\PregnancyExaminationReport;
use App\Models\Schedule;
use App\Models\Service;
use App\Notifications\OrderComingsoon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
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
    public function history_detail(Order $order)
    {
        $record = null;
        $report = null;
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $pregnancy_examination = $order->pregnancy_examination()->first();
            if ($pregnancy_examination) {
                $record = PregnancyExamination::formable()->from_update(
                    model: $pregnancy_examination,
                    fields: [
                        'first_day_of_last_mesntruation',
                        'estimated_day_of_birth',
                        'upper_arm_circle',
                        'kek',
                        'height',
                        'blood_group',
                        'use_of_contraception_before_pregnancy',
                        'history_of_illness_suffered_by_the_mother',
                        'history_of_allergies',
                        'number_of_pregnancies',
                        'number_of_births',
                        'number_of_miscarriages',
                        'number_of_living_children',
                        'number_of_stillbirths',
                        'number_of_children_born_preterm',
                        'the_distance_between_this_pregnancy_and_the_last_delivery',
                        'latest_tt_immunization_status',
                        'last_helper_in_childbirth',
                        'last_method_of_delivery',
                        'last_method_of_delivery_action',
                    ],
                );
                $report = PregnancyExaminationReport::tableable();
                $report->options['filter_by_column'] = false;
                $report->options['selectable'] = false;
                $report->options['sortable'] = false;
                $report->options['action'] = false;
                $report->query = fn ($q) => $q->where('pregnancy_examination_id', $pregnancy_examination->id);
                $report->from_request(
                    request: request(),
                    columns: [
                        'created_at',
                        'complaint',
                        'blood_pressure',
                        'weight',
                        'pregnancy_age',
                        'fundal_height',
                        'location_of_the_fetus',
                        'fetal_heart_rate',
                        'swollen_foot',
                        'laboratory_examination_results',
                        'action',
                        'advice',
                        'description',
                        'when_to_return',
                    ],
                );
            }
        }
        return view('pages.patient.history_detail', [
            'order' => $order,
            'record' => $record,
            'report' => $report,
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
