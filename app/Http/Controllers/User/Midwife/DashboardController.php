<?php

namespace App\Http\Controllers\User\Midwife;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Midwife\UpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\EarPierching;
use App\Models\FamilyPlanning;
use App\Models\FamilyPlanningRevisit;
use App\Models\Midwife;
use App\Models\NewbornCare;
use App\Models\Order;
use App\Models\PostpartumHealth;
use App\Models\PregnancyExamination;
use App\Models\PregnancyExaminationReport;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

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
            // 'schedule' => 1,
            'schedules' => $schedules,
            'schedules_coll' => $schedules_coll,
            'orders' => $orders,
            'orders_limit' =>  Cache::get('orders_limit', [
                'date' => now()->toDateString(),
                'limit' => 3,
            ]),
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
        } else if ($order->service->name == 'pelayanan KB') {
            $model = $order->family_planning;
            if ($model) {
                $record = FamilyPlanning::formable()->from_update(
                    model: $model,
                    fields: [
                        'participant_name',
                        'husband_or_wife_name',
                        'birthday_or_age_wife',
                        'participant_address',
                        'tool_or_medicine_or_treatment_method',
                        'attach_date',
                        'detach_date',
                    ],
                );
                $report = FamilyPlanningRevisit::tableable();
                $report->options['filter_by_column'] = false;
                $report->options['selectable'] = false;
                $report->options['sortable'] = false;
                $report->options['action'] = false;
                $report->query = fn ($q) => $q->where('family_planning_id', $model->id);
                $report->from_request(
                    request: request(),
                    columns: [
                        'created_at',
                        'description',
                    ],
                );
            }
        } else if ($order->service->name == 'tindik telinga') {
            $model = $order->ear_pierching;
            if ($model) {
                $record = EarPierching::formable()->from_update(
                    model: $model,
                    fields: [
                        'name',
                        'birthday',
                        'age',
                        'gender',
                    ],
                );
            }
        } else if ($order->service->name == 'perawatan bayi baru lahir') {
            $model = $order->newborn_cares;
            if (count($model)) {
                $record = [];
                foreach ($order->newborn_cares as $model) {
                    $form = NewbornCare::formable()->from_update(
                        model: $model,
                        fields: [
                            'body_weight',
                            'body_length',
                            'body_temperature',
                            'breathing_frequency',
                            'heart_rate_frequency',
                            'check_possible_serious_illnesses',
                            'check_jaundice',
                            'check_diarrhea',
                            'check_low_body_weight_and_problems_breastfeeding',
                            'check_vit_k1_status',
                            'check_hb_0_bcg_polio_1_immunization_status',
                            'areas_that_have_implemented_Congenital_Hypothyroidism',
                            'shk',
                            'shk_test_result',
                        ],
                    );
                    $record[] = $form;
                }
            }
        } else if ($order->service->name == 'pelayanan kesehatan masa nifas') {
            $model = $order->postpartum_healths;
            if (count($model)) {
                $record = [];
                foreach ($order->postpartum_healths as $model) {
                    $form = PostpartumHealth::formable()->from_update(
                        model: $model,
                        fields: [
                            "general_condition_of_the_mother",
                            "blood_pressure_body_temperature_respiration_pulse",
                            "vaginal_bleeding",
                            "perineal_conditions",
                            "signs_of_infection",
                            "fundus_uteri_height",
                            "lochia",
                            "birth_canal_examination",
                            "breast_examination",
                            "lactation",
                            "give_capsules_vit_a",
                            "postpartum_contraceptive_services",
                            "high_risk_treatment_and_complications_in_postpartum",
                            "visit_note",
                        ],
                    );
                    $record[] = $form;
                }
            }
        }
        return view('pages.midwife.history_detail', [
            'order' => $order,
            'record' => $record,
            'report' => $report,
        ]);
    }

    public function map_navigation(mixed $coord)
    {
        return view("pages.midwife.map_navigation", [
            'coord' => $coord,
        ]);
    }
    public function orders_limit_set()
    {
        return view('pages.midwife.orders_limit_set', Cache::get("orders_limit", [
            'date' => now()->toDateString(),
            'limit' => 3,
        ]));
    }
    public function orders_limit_set_handle(Request $request)
    {
        $data = Validator::make($request->all(), [
            'date' => 'required|string',
            'limit' => 'required|integer|min:1',
        ])->validate();
        Cache::forever("orders_limit", $data);
        return to_route('web.midwife.dashboard');
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
