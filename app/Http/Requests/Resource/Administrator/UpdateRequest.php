<?php

namespace App\Http\Requests\Resource\Administrator;

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
            'photo' => 'nullable|image|max:2048',
            'name' => 'required|string|unique:administrators,name,'.request()->route('administrator.id'),
            'fullname' => 'required|string',
            'address' => 'required|string',
            'telp' => 'required|string|unique:administrators,telp,'.request()->route('administrator.id'),
            'email' => 'required|email|unique:administrators,email,'.request()->route('administrator.id'),
            'password' => 'nullable|string',
        ];
    }
}
