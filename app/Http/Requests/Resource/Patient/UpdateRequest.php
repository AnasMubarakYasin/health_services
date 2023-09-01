<?php

namespace App\Http\Requests\Resource\Patient;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:patients,name,'.request()->route('patient.id'),
            'password' => 'required|string',
            'photo' => 'nullable|image|max:10485',
            'fullname' => 'nullable|string',
            'email' => 'nullable|email|unique:patients,email,'.request()->route('patient.id'),
            'telp' => 'nullable|string|unique:patients,telp,'.request()->route('patient.id'),
            "age" => "nullable|integer",
            "weight" => "nullable|integer",
            "height" => "nullable|integer",
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
        ];
    }
}
