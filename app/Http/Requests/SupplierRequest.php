<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('suppliers')->ignore($this->id)
            ],
            'pic_name' => 'required',
            'phone_number' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nama supplier tidak boleh kosong',
            'name.unique' => 'Nama supplier sudah ada',
            'pic_name.required' => 'Nama PIC tidak boleh kosong',
            'phone_number.required' => 'Nomor telepon/handphone tidak boleh kosong',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'msg_title' => 'Gagal',
            'msg_body' => json_encode($validator->errors())
        ], 422));
    }
}
