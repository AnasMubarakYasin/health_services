<?php

namespace App\Http\Requests\Resource\Record;

use Illuminate\Foundation\Http\FormRequest;

class PregnancyExaminationCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
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
        ];
    }
}
