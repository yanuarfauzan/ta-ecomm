<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddAddressessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'required|array',
            'address.*.address' => 'required',
            'address.*.postal_code' => 'required',
            'address.*.province' => 'required',
            'address.*.city' => 'required',
            'address.*.detail' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'address.required' => 'Alamat tidak boleh kosong',
            'address.*.address.required' => 'Alamat tidak boleh kosong',
            'address.*.postal_code.required' => 'Kode pos tidak boleh kosong',
            'address.*.province.required' => 'Provinsi tidak boleh kosong',
            'address.*.city.required' => 'Kota tidak boleh kosong',
            'address.*.detail.required' => 'Detail alamat tidak boleh kosong',

        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ]));
    }
}
