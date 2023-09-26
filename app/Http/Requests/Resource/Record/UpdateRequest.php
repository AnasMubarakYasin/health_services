<?php

namespace App\Http\Requests\Resource\Record;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'started_at' => 'required|date_format:H:i',
            'ended_at' => 'required|date_format:H:i',
            'active' => 'required|boolean',
            'midwife_id' => 'required|uuid'
        ];
    }
}
