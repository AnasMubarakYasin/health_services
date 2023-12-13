<?php

namespace App\Http\Requests\Resource\OrderLimit;

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
            'limit' => 'required|integer',
            'date' => 'required|date',
            'midwife_id' => 'required|uuid',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->input('date')) {
            // dd($this->all());
            $this->merge(['date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input('date'))))]);
            // dd($this->all());
        }
    }
}
