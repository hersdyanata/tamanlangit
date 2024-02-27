<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ReservasiOnsiteRequest extends FormRequest
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
            'room_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'wa_number' => 'required',
            'persons' => 'required',
        ];
    }

    public function messages(){
        return [
            'room_id.required' => 'Silahkan pilih tenda',
            'name.required' => 'Nama pemesan tidak boleh kosong',
            'email.required' => 'Email pemesan tidak boleh kosong',
            'wa_number.required' => 'Silahkan isi nomor telepon yang terhubung ke Whatsapp',
            'persons.required' => 'Silahkan tentukan jumlah peserta',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'msg_title' => 'Gagal',
            'msg_body' => json_encode($validator->errors())
        ], 422));
    }
}
