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
            'started_at' => 'required|date_format:H:i',
            'ended_at' => 'required|date_format:H:i',
            'patient_id' => 'required|uuid',
            'service_id' => 'required|uuid',
        ];
    }
}
