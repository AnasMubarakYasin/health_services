<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'date' => 'required|date_format:d/m/Y',
            'time' => 'required|date_format:H',
            'location' => 'required|string',
            'position' => 'required|string',
            'midwife' => 'required|uuid',
            // 'service_id' => 'required|uuid',
        ];
    }
}
