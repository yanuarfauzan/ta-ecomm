<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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
    public function rules()
    {
        return [
            'username' => ['required', 'alpha_dash', 'min:3', 'max:20', 'unique:user,username'],
            'email' => ['required', 'email', Rule::unique('user', 'email'), 'max:255'],
            'phone_number' => 'required|numeric|digits_between:10,15',
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'different:username'
            ],
            'gender' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username tidak boleh kosong',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, dan tanda hubung',
            'username.min' => 'Panjang username minimal 3 karakter',
            'username.max' => 'Panjang username maksimal 20 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah terdaftar',
            'phone_number.required' => 'Nomor handphone tidak boleh kosong',
            'phone_number.numeric' => 'Nomor handphone harus berupa angka',
            'phone_number.digits_between' => 'Panjang nomor handphone antara 10 sampai dengan 15 digit',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.regex' => 'Harus mengandung huruf besar, kecil, angka, dan simbol',
            'password.different' => 'Password dan username tidak boleh sama',
            'gender.required' => 'Jenis kelamin wajib di isi'
        ];
    }

    public function withInput()
    {
        return $this->validator->withErrors($this->errors());
    }
}
