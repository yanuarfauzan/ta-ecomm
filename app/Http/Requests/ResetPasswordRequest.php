<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
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
            'new_password' => [
                'required',
                'confirmed',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'different:username'
            ],
        ];
    }
    public function messages()
    {
        return [
            'new_password.required' => 'Password baru tidak boleh kosong',
            'new_password.confirmed' => 'Konfirmasi password baru salah',
            'new_password.string' => 'Password harus berupa string',
            'new_password.min' => 'Panjang password minimal 8 karakter',
            'new_password.regex' => 'Password harus mengandung huruf besar dan huruf kecil, angka, simbol dan spasi',
            'new_password.different' => 'Password dan username tidak boleh sama',
        ];
    }
}
