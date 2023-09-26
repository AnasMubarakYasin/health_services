<?php

namespace App\Http\Controllers\User\Midwife;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\Midwife\UpdateRequest;
use App\Http\Requests\Resource\Record\PregnancyExaminationCreateRequest;
use App\Http\Requests\Resource\Record\PregnancyExaminationUpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ChangeProfileRequest;
use App\Models\Midwife;
use App\Models\Order;
use App\Models\PregnancyExamination;
use App\Models\PregnancyExaminationReport;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            return view('pages.midwife.record', [
                'order' => $order,
                'pregnancy_examination' => $pregnancy_examination,
                'pregnancy_examination_report' => $pregnancy_examination_report,
            ]);
        }
    }
    public function create(PregnancyExaminationCreateRequest $request, Order $order)
    {
        $data = $request->validated();
        $data['first_day_of_last_mesntruation'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['first_day_of_last_mesntruation'])));
        $data['estimated_day_of_birth'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['estimated_day_of_birth'])));
        $pregnancy_examination = new PregnancyExamination($data);
        $pregnancy_examination->order_id = $order->id;
        $pregnancy_examination->save();
        $pregnancy_examination_report = new PregnancyExaminationReport($data);
        $pregnancy_examination_report->pregnancy_examination_id = $pregnancy_examination->id;
        $pregnancy_examination_report->save();
        return to_route('web.midwife.dashboard');
    }
    public function update(PregnancyExaminationUpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        isset($data['first_day_of_last_mesntruation']) && ($data['first_day_of_last_mesntruation'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['first_day_of_last_mesntruation']))));
        isset($data['estimated_day_of_birth']) && ($data['estimated_day_of_birth'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['estimated_day_of_birth']))));
        $pregnancy_examination = $order->pregnancy_examination()->first();
        $pregnancy_examination->update($data);
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
        }
        return to_route('web.midwife.record.edit', ['order' => $order]);
    }
    public function delete_report(Order $order, string $report)
    {
        if ($order->service->name == 'pemeriksaan kehamilan') {
            PregnancyExaminationReport::destroy($report);
        }
        return to_route('web.midwife.record.edit', ['order' => $order]);
    }
}
