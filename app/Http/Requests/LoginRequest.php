<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'login.required' => 'Username atau email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        return back()->withErrors($validator->errors())->withInput();
    }
}