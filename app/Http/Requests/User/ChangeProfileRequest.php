<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photo' => 'nullable|image|max:10485',
            'name' => 'required|string|unique:users,name,'.request()->route('user.id'),
            'fullname' => 'required|string',
            'address' => 'required|string',
            'telp' => 'required|string|unique:users,telp,'.request()->route('user.id'),
            'email' => 'required|email|unique:users,email,'.request()->route('user.id'),
            'password' => 'nullable|string',
        ];
    }
}
