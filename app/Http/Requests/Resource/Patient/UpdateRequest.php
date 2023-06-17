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
            'name' => 'required|string',
            'password' => 'required|string',
            'photo' => 'nullable|image|size:2048',
            'fullname' => 'nullable|string',
            'email' => 'nullable|email',
        ];
    }
}
