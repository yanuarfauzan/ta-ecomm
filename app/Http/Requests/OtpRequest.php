<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OtpRequest extends FormRequest
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
            'first' => 'required|numeric',
            'second' => 'required|numeric',
            'third' => 'required|numeric',
            'fourth' => 'required|numeric',
            'fivth' => 'required|numeric',
            'sixth' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Otp tidak boleh kosong',
            'numeric' => 'Otp harus berupa nomor' 
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ]));
        // return back()->withErrors($validator->errors())->withInput();
    }
}
