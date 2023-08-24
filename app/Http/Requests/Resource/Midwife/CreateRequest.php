<?php

namespace App\Http\Requests\Resource\Midwife;

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
            'name' => 'required|string',
            'password' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'fullname' => 'nullable|string',
        ];
    }
}
