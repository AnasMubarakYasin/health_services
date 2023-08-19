<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'status' => 'required|in:finished,on_progress,scheduled',
            'schedule' => 'required|date',
            'schedule_start' => 'required|date_format:H:i',
            'schedule_end' => 'required|date_format:H:i',
            'location_name' => 'required|string',
            'location_coordinates' => 'required|json',
            'complaint' => 'nullable|string',
            'patient_id' => 'required|uuid',
            'midwife_id' => 'required|uuid',
            'service_id' => 'required|uuid',
        ];
    }
}
