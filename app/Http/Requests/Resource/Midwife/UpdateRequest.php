<?php

namespace App\Http\Requests\Resource\Midwife;

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
            'name' => 'required|string|unique:midwives,name,'.request()->route('midwife.id'),
            'password' => 'required|string',
            'photo' => 'nullable|image|max:10485',
            'fullname' => 'nullable|string',
            'email' => 'nullable|email|unique:midwives,email,'.request()->route('midwife.id'),
            'telp' => 'nullable|string|unique:midwives,telp,'.request()->route('midwife.id'),
            'srt' => 'nullable|string|unique:midwives,srt,'.request()->route('midwife.id'),
        ];
    }
}
