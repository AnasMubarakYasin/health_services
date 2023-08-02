<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'status' => 'required|in:ready,not ready',
            'schedule' => 'required|date',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'patient_id' => 'required',
            'service_id' => 'required'

        ];
    }
}
