<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddProductToCartRequest extends FormRequest
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
            'qty' => 'required|numeric',
            'category_id' => 'required',
            'variation' => 'required|array',
            'variation.*.variation_id' => 'required',
            'variation.*.variation_option_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'qty.required' => 'Jumlah minimal satu',
            'category_id.required' => 'Category id tidak boleh kosong',
            'variation.*.variation_id.required' => 'Variation id tidak boleh kosong',
            'variation.*.variation_option_id.required' => 'Variation Option id tidak boleh kosong'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ]));
    }
}
