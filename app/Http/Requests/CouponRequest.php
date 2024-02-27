<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'code' => [
                'required',
                Rule::unique('coupons')->ignore($this->id)
            ],
            'description' => 'required',
            'periode' => 'required',
            'quantity' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'valid_for' => 'required',
        ];
    }

    public function messages(){
        return [
            'code.required' => 'Kode kupon tidak boleh kosong',
            'code.unique' => 'Kode kupon ini sudah pernah digunakan',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'quantity.required' => 'Quantity kupon tidak boleh kosong',
            'discount_type.required' => 'Jenis diskon tidak boleh kosong',
            'discount.required' => 'Diskon tidak boleh kosong',
            'valid_for.required' => 'Tentukan kupon ini berlaku untuk reservasi yang mana'
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'msg_title' => 'Gagal',
            'msg_body' => json_encode($validator->errors())
        ], 422));
    }
}
