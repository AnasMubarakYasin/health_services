<?php

namespace App\Http\Controllers\User\Midwife;

use App\Http\Controllers\Controller;
use App\Models\EarPierching;
use App\Models\FamilyPlanning;
use App\Models\FamilyPlanningRevisit;
use App\Models\NewbornCare;
use App\Models\Order;
use App\Models\PostpartumHealth;
use App\Models\PregnancyExamination;
use App\Models\PregnancyExaminationReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    public $pregnancy_examination_fields = [
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
    ];
    public $pregnancy_examination_report_fields = [
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
    ];
    public $family_planning_fields = [
        'participant_name',
        'husband_or_wife_name',
        'birthday_or_age_wife',
        'participant_address',
        'tool_or_medicine_or_treatment_method',
        'attach_date',
        'detach_date',
    ];
    public $family_planning_revisit_fields = [
        'created_at',
        'description',
    ];
    public $ear_pierching_fields = [
        'name',
        'birthday',
        'age',
        'gender',
    ];
    public $newborn_care_fields = [
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
        // 'visit_number',
        // 'visit_description',
    ];
    public $postpartum_health_fields = [
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
        // "visit_string",
        // "visit_description",
        "visit_note",
    ];
    public function edit(Order $order)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $pregnancy_examination = PregnancyExamination::formable();
            $model = $order->pregnancy_examination()->first();
            $model ? $pregnancy_examination->from_update(
                model: $model,
                fields: $this->pregnancy_examination_fields,
            ) : $pregnancy_examination->from_create(
                fields: $this->pregnancy_examination_fields,
            );
            if ($pregnancy_examination->is_update()) {
                $pregnancy_examination_report = PregnancyExaminationReport::tableable();
                $pregnancy_examination_report->options['filter_by_column'] = false;
                $pregnancy_examination_report->options['selectable'] = false;
                $pregnancy_examination_report->query = fn ($q) => $q->where('pregnancy_examination_id', $model->id);
                $pregnancy_examination_report->from_request(
                    request: request(),
                    columns: $this->pregnancy_examination_report_fields,
                );
                $pregnancy_examination_report->web_create = function () use ($order) {
                    return route('web.midwife.record.report.add', ['order' => $order]);
                };
                $pregnancy_examination_report->web_update = function ($item) use ($order) {
                    return route('web.midwife.record.report.edit', ['order' => $order, 'report' => $item->id]);
                };
                $pregnancy_examination_report->api_delete = function ($item) use ($order) {
                    return route('web.midwife.record.report.delete', ['order' => $order, 'report' => $item->id]);
                };
            } else {
                $pregnancy_examination_report = PregnancyExaminationReport::formable()->from_create(
                    fields: $this->pregnancy_examination_report_fields,
                    hidden: [
                        'created_at',
                    ]
                );
            }
            return view('pages.midwife.record.pregnant_examination', [
                'order' => $order,
                'pregnancy_examination' => $pregnancy_examination,
                'pregnancy_examination_report' => $pregnancy_examination_report,
            ]);
        } else if ($order->service->name == 'pelayanan KB') {
            $family_planning = FamilyPlanning::formable();
            $model = $order->family_planning;
            $model ? $family_planning->from_update(
                model: $model,
                fields: $this->family_planning_fields,
            ) : $family_planning->from_create(
                fields: $this->family_planning_fields,
            );
            if ($family_planning->is_update()) {
                $family_planning_revisit = FamilyPlanningRevisit::tableable();
                $family_planning_revisit->options['filter_by_column'] = false;
                $family_planning_revisit->options['selectable'] = false;
                $family_planning_revisit->query = fn ($q) => $q->where('family_planning_id', $model->id);
                $family_planning_revisit->from_request(
                    request: request(),
                    columns: $this->family_planning_revisit_fields,
                );
                $family_planning_revisit->web_create = function () use ($order) {
                    return route('web.midwife.record.report.add', ['order' => $order]);
                };
                $family_planning_revisit->web_update = function ($item) use ($order) {
                    return route('web.midwife.record.report.edit', ['order' => $order, 'report' => $item->id]);
                };
                $family_planning_revisit->api_delete = function ($item) use ($order) {
                    return route('web.midwife.record.report.delete', ['order' => $order, 'report' => $item->id]);
                };
            } else {
                $family_planning_revisit = FamilyPlanningRevisit::formable()->from_create(
                    fields: $this->family_planning_revisit_fields,
                    hidden: [
                        'created_at',
                    ]
                );
            }
            return view('pages.midwife.record.family_planning', [
                'order' => $order,
                'family_planning' => $family_planning,
                'family_planning_revisit' => $family_planning_revisit,
            ]);
        } else if ($order->service->name == 'tindik telinga') {
            $form = EarPierching::formable();
            $model = $order->ear_pierching;
            $model ? $form->from_update(
                model: $model,
                fields: $this->ear_pierching_fields,
            ) : $form->from_create(
                fields: $this->ear_pierching_fields,
            );
            return view('pages.midwife.record.ear_pierching', [
                'order' => $order,
                'form' => $form,
            ]);
        } else if ($order->service->name == 'perawatan bayi baru lahir') {
            $forms = [];
            foreach ($order->newborn_cares as $model) {
                $form = NewbornCare::formable()->from_update(
                    model: $model,
                    fields: $this->newborn_care_fields,
                );
                $forms[] = $form;
            }
            $form = NewbornCare::formable()->from_create(
                fields: $this->newborn_care_fields,
            );
            $form->model->visit_number = (count($order->newborn_cares ?: [])) + 1;
            $form->model->visit_description = "visit {$form->model->visit_number}";
            $forms[] = $form;
            return view('pages.midwife.record.newborn_care', [
                'order' => $order,
                'forms' => $forms,
            ]);
        } else if ($order->service->name == 'pelayanan kesehatan masa nifas') {
            $forms = [];
            foreach ($order->postpartum_healths as $model) {
                $form = PostpartumHealth::formable()->from_update(
                    model: $model,
                    fields: $this->postpartum_health_fields,
                );
                $forms[] = $form;
            }
            $form = PostpartumHealth::formable()->from_create(
                fields: $this->postpartum_health_fields,
            );
            $form->model->visit_number = (count($order->postpartum_healths ?: [])) + 1;
            $form->model->visit_description = "visit {$form->model->visit_number}";
            $forms[] = $form;
            return view('pages.midwife.record.postpartum_health', [
                'order' => $order,
                'forms' => $forms,
            ]);
        }
    }
    public function create(Request $request, Order $order)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $data = Validator::make($request->all(), [
                'first_day_of_last_mesntruation' => 'required|string',
                'estimated_day_of_birth' => 'required|string',
                'upper_arm_circle' => 'required|integer',
                'kek' => 'nullable|boolean',
                'height' => 'required|integer',
                'blood_group' => 'required|string',
                'use_of_contraception_before_pregnancy' => 'nullable|string',
                'history_of_illness_suffered_by_the_mother' => 'nullable|string',
                'history_of_allergies' => 'nullable|string',
                'number_of_pregnancies' => 'required|integer',
                'number_of_births' => 'required|integer',
                'number_of_miscarriages' => 'required|integer',
                'number_of_living_children' => 'nullable|integer',
                'number_of_stillbirths' => 'nullable|integer',
                'number_of_children_born_preterm' => 'nullable|integer',
                'the_distance_between_this_pregnancy_and_the_last_delivery' => 'required|string',
                'latest_tt_immunization_status' => 'nullable|string',
                'last_helper_in_childbirth' => 'required|string',
                'last_method_of_delivery' => 'required|string',
                'last_method_of_delivery_action' => 'nullable|required_if:last_method_of_delivery,action|string',
                'complaint' => 'nullable|string',
                'blood_pressure' => 'required|string',
                'weight' => 'required|integer',
                'pregnancy_age' => 'required|integer',
                'fundal_height' => 'nullable|integer',
                'location_of_the_fetus' => 'nullable|string',
                'fetal_heart_rate' => 'nullable|integer',
                'swollen_foot' => 'nullable|boolean',
                'laboratory_examination_results' => 'required|string',
                'action' => 'required|string',
                'advice' => 'required|string',
                'description' => 'required|string',
                'when_to_return' => 'nullable|string',
            ])->validate();
            $data['first_day_of_last_mesntruation'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['first_day_of_last_mesntruation'])));
            $data['estimated_day_of_birth'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['estimated_day_of_birth'])));
            $pregnancy_examination = new PregnancyExamination($data);
            $pregnancy_examination->order_id = $order->id;
            $pregnancy_examination->save();
            $pregnancy_examination_report = new PregnancyExaminationReport($data);
            $pregnancy_examination_report->pregnancy_examination_id = $pregnancy_examination->id;
            $pregnancy_examination_report->save();
        } else if ($order->service->name == 'pelayanan KB') {
            $data = Validator::make($request->all(), [
                'participant_name' => 'required|string',
                'husband_or_wife_name' => 'required|string',
                'birthday_or_age_wife' => 'required|string',
                'participant_address' => 'required|string',
                'tool_or_medicine_or_treatment_method' => 'required|string',
                'attach_date' => 'required|string',
                'detach_date' => 'required|string',
                'description' => 'required|string',
            ])->validate();
            $data['attach_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['attach_date'])));
            $data['detach_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['detach_date'])));
            $family_planning = new FamilyPlanning($data);
            $family_planning->order_id = $order->id;
            $family_planning->save();
            $family_planning_revisit = new FamilyPlanningRevisit($data);
            $family_planning_revisit->family_planning_id = $family_planning->id;
            $family_planning_revisit->save();
        } else if ($order->service->name == 'tindik telinga') {
            $data = Validator::make($request->all(), [
                'name' => 'required|string',
                'birthday' => 'required|string',
                'age' => 'required|string',
                'gender' => 'required|string',
            ])->validate();
            $data['birthday'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['birthday'])));
            $model = new EarPierching($data);
            $model->order_id = $order->id;
            $model->save();
        } else if ($order->service->name == 'perawatan bayi baru lahir') {
            $data = Validator::make($request->all(), [
                'body_weight' => 'required|integer',
                'body_length' => 'required|integer',
                'body_temperature' => 'required|integer',
                'breathing_frequency' => 'required|string',
                'heart_rate_frequency' => 'required|string',
                'check_possible_serious_illnesses' => 'required|string',
                'check_jaundice' => 'required|string',
                'check_diarrhea' => 'required|string',
                'check_low_body_weight_and_problems_breastfeeding' => 'required|string',
                'check_vit_k1_status' => 'required|string',
                'check_hb_0_bcg_polio_1_immunization_status' => 'required|string',
                'areas_that_have_implemented_Congenital_Hypothyroidism' => 'required|string',
                'shk' => 'required|boolean',
                'shk_test_result' => 'required|string',
            ])->validate();
            $model = new NewbornCare($data);
            $model->visit_number = (count($order->newborn_cares ?: [])) + 1;
            $model->visit_description = "visit {$model->visit_number}";
            $model->order_id = $order->id;
            $model->save();
        } else if ($order->service->name == 'pelayanan kesehatan masa nifas') {
            $data = Validator::make($request->all(), [
                "general_condition_of_the_mother" => 'required|string',
                "blood_pressure_body_temperature_respiration_pulse" => 'required|string',
                "vaginal_bleeding" => 'required|string',
                "perineal_conditions" => 'required|string',
                "signs_of_infection" => 'required|string',
                "fundus_uteri_height" => 'required|string',
                "lochia" => 'required|string',
                "birth_canal_examination" => 'required|string',
                "breast_examination" => 'required|string',
                "lactation" => 'required|string',
                "give_capsules_vit_a" => 'required|string',
                "postpartum_contraceptive_services" => 'required|string',
                "high_risk_treatment_and_complications_in_postpartum" => 'required|string',
                "visit_note" => 'required|string',
            ])->validate();
            $model = new PostpartumHealth($data);
            $model->visit_number = (count($order->postpartum_healths ?: [])) + 1;
            $model->visit_description = "visit {$model->visit_number}";
            $model->order_id = $order->id;
            $model->save();
        }
        return to_route('web.midwife.dashboard');
    }
    public function update(Request $request, Order $order)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $data = Validator::make($request->all(), [
                'first_day_of_last_mesntruation' => 'required|string',
                'estimated_day_of_birth' => 'required|string',
                'upper_arm_circle' => 'required|integer',
                'kek' => 'nullable|boolean',
                'height' => 'required|integer',
                'blood_group' => 'required|string',
                'use_of_contraception_before_pregnancy' => 'nullable|string',
                'history_of_illness_suffered_by_the_mother' => 'nullable|string',
                'history_of_allergies' => 'nullable|string',
                'number_of_pregnancies' => 'required|integer',
                'number_of_births' => 'required|integer',
                'number_of_miscarriages' => 'required|integer',
                'number_of_living_children' => 'nullable|integer',
                'number_of_stillbirths' => 'nullable|integer',
                'number_of_children_born_preterm' => 'nullable|integer',
                'the_distance_between_this_pregnancy_and_the_last_delivery' => 'required|string',
                'latest_tt_immunization_status' => 'nullable|string',
                'last_helper_in_childbirth' => 'required|string',
                'last_method_of_delivery' => 'required|string',
                'last_method_of_delivery_action' => 'nullable|required_if:last_method_of_delivery,action|string',
            ])->validate();
            isset($data['first_day_of_last_mesntruation']) && ($data['first_day_of_last_mesntruation'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['first_day_of_last_mesntruation']))));
            isset($data['estimated_day_of_birth']) && ($data['estimated_day_of_birth'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['estimated_day_of_birth']))));
            $pregnancy_examination = $order->pregnancy_examination;
            $pregnancy_examination->update($data);
        } else if ($order->service->name == 'pelayanan KB') {
            $data = Validator::make($request->all(), [
                'participant_name' => 'required|string',
                'husband_or_wife_name' => 'required|string',
                'birthday_or_age_wife' => 'required|string',
                'participant_address' => 'required|string',
                'tool_or_medicine_or_treatment_method' => 'required|string',
                'attach_date' => 'required|string',
                'detach_date' => 'required|string',
            ])->validate();
            $data['attach_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['attach_date'])));
            $data['detach_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['detach_date'])));
            $family_planning = $order->family_planning;
            $family_planning->update($data);
        } else if ($order->service->name == 'tindik telinga') {
            $data = Validator::make($request->all(), [
                'name' => 'required|string',
                'birthday' => 'required|string',
                'age' => 'required|string',
                'gender' => 'required|string',
            ])->validate();
            $data['birthday'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['birthday'])));
            $model = $order->ear_pierching;
            $model->update($data);
        } else if ($order->service->name == 'perawatan bayi baru lahir') {
            $data = Validator::make($request->all(), [
                'body_weight' => 'required|integer',
                'body_length' => 'required|integer',
                'body_temperature' => 'required|integer',
                'breathing_frequency' => 'required|string',
                'heart_rate_frequency' => 'required|string',
                'check_possible_serious_illnesses' => 'required|string',
                'check_jaundice' => 'required|string',
                'check_diarrhea' => 'required|string',
                'check_low_body_weight_and_problems_breastfeeding' => 'required|string',
                'check_vit_k1_status' => 'required|string',
                'check_hb_0_bcg_polio_1_immunization_status' => 'required|string',
                'areas_that_have_implemented_Congenital_Hypothyroidism' => 'required|string',
                'shk' => 'required|boolean',
                'shk_test_result' => 'required|string',
            ])->validate();
            $model = NewbornCare::find($request->input('id'));
            $model->update($data);
        } else if ($order->service->name == 'pelayanan kesehatan masa nifas') {
            $data = Validator::make($request->all(), [
                "general_condition_of_the_mother" => 'required|string',
                "blood_pressure_body_temperature_respiration_pulse" => 'required|string',
                "vaginal_bleeding" => 'required|string',
                "perineal_conditions" => 'required|string',
                "signs_of_infection" => 'required|string',
                "fundus_uteri_height" => 'required|string',
                "lochia" => 'required|string',
                "birth_canal_examination" => 'required|string',
                "breast_examination" => 'required|string',
                "lactation" => 'required|string',
                "give_capsules_vit_a" => 'required|string',
                "postpartum_contraceptive_services" => 'required|string',
                "high_risk_treatment_and_complications_in_postpartum" => 'required|string',
                "visit_note" => 'required|string',
            ])->validate();
            $model = PostpartumHealth::find($request->input('id'));
            $model->update($data);
        }
        return to_route('web.midwife.dashboard');
    }

    public function add_report(Order $order)
    {
        $report = null;
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $report = PregnancyExaminationReport::formable()->from_create(
                fields: $this->pregnancy_examination_report_fields,
                hidden: [
                    'created_at',
                ],
            );
            $report->api_create = function () use ($order) {
                return route('web.midwife.record.report.create', ['order' => $order]);
            };
        } else if ($order->service->name == "pelayanan KB") {
            $report = FamilyPlanningRevisit::formable()->from_create(
                fields: $this->family_planning_revisit_fields,
                hidden: [
                    'created_at',
                ],
            );
            $report->api_create = function () use ($order) {
                return route('web.midwife.record.report.create', ['order' => $order]);
            };
        }
        return view('pages.midwife.report_add', [
            'order' => $order,
            'report' => $report,
        ]);
    }
    public function create_report(Request $request, Order $order)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $data = Validator::make($request->all(), [
                'complaint' => 'nullable|string',
                'blood_pressure' => 'required|string',
                'weight' => 'required|integer',
                'pregnancy_age' => 'required|integer',
                'fundal_height' => 'nullable|integer',
                'location_of_the_fetus' => 'nullable|string',
                'fetal_heart_rate' => 'nullable|integer',
                'swollen_foot' => 'nullable|boolean',
                'laboratory_examination_results' => 'required|string',
                'action' => 'required|string',
                'advice' => 'required|string',
                'description' => 'required|string',
                'when_to_return' => 'nullable|string',
            ])->validate();
            $report = new PregnancyExaminationReport($data);
            $report->pregnancy_examination_id = $order->pregnancy_examination->id;
            $report->save();
        } else if ($order->service->name == 'pelayanan KB') {
            $data = Validator::make($request->all(), [
                'description' => 'required|string',
            ])->validate();
            $report = new FamilyPlanningRevisit($data);
            $report->family_planning_id = $order->family_planning->id;
            $report->save();
        }
        return to_route('web.midwife.record.edit', ['order' => $order]);
    }
    public function edit_report(Order $order, string $report)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $report = PregnancyExaminationReport::formable()->from_update(
                model: PregnancyExaminationReport::find($report),
                fields: $this->pregnancy_examination_report_fields,
                hidden: [
                    'created_at',
                ],
            );
            $report->api_update = function ($item) use ($order) {
                return route('web.midwife.record.report.update', ['order' => $order, 'report' => $item->id]);
            };
        } else if ($order->service->name == "pelayanan KB") {
            $report = FamilyPlanningRevisit::formable()->from_update(
                model: FamilyPlanningRevisit::find($report),
                fields: $this->family_planning_revisit_fields,
                hidden: [
                    'created_at',
                ],
            );
            $report->api_update = function ($item) use ($order) {
                return route('web.midwife.record.report.update', ['order' => $order, 'report' => $item->id]);
            };
        }
        return view('pages.midwife.report_edit', [
            'order' => $order,
            'report' => $report,
        ]);
    }
    public function update_report(Request $request, Order $order, string $report)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            $data = Validator::make($request->all(), [
                'complaint' => 'nullable|string',
                'blood_pressure' => 'required|string',
                'weight' => 'required|integer',
                'pregnancy_age' => 'required|integer',
                'fundal_height' => 'nullable|integer',
                'location_of_the_fetus' => 'nullable|string',
                'fetal_heart_rate' => 'nullable|integer',
                'swollen_foot' => 'nullable|boolean',
                'laboratory_examination_results' => 'required|string',
                'action' => 'required|string',
                'advice' => 'required|string',
                'description' => 'required|string',
                'when_to_return' => 'nullable|string',
            ])->validate();
            $report = PregnancyExaminationReport::find($report);
            $report->update($data);
        } else if ($order->service->name == 'pelayanan KB') {
            $data = Validator::make($request->all(), [
                'description' => 'required|string',
            ])->validate();
            $report = FamilyPlanningRevisit::find($report);
            $report->update($data);
        }
        return to_route('web.midwife.record.edit', ['order' => $order]);
    }
    public function delete_report(Order $order, string $report)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            PregnancyExaminationReport::destroy($report);
        } else if ($order->service->name == 'pelayanan KB') {
            FamilyPlanningRevisit::destroy($report);
        }
        return to_route('web.midwife.record.edit', ['order' => $order]);
    }
}
