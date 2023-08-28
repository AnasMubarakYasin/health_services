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
            'name' => 'required|string|unique:midwives,name',
            'password' => 'required|string',
            'photo' => 'nullable|image|max:10485',
            'fullname' => 'nullable|string',
            'email' => 'nullable|email|unique:midwives,email',
            'telp' => 'nullable|string|unique:midwives,telp',
        ];
    }
}
