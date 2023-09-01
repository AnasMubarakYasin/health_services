<?php

namespace App\Http\Requests\Resource\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:patients,name',
            'password' => 'required|string',
            'photo' => 'nullable|image|max:10485',
            'fullname' => 'nullable|string',
            'email' => 'nullable|email|unique:patients,email',
            'telp' => 'nullable|string|unique:patients,telp',
            "age" => "nullable|integer",
            "weight" => "nullable|integer",
            "height" => "nullable|integer",
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
        ];
    }
}
