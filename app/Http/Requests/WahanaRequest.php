<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class WahanaRequest extends FormRequest
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
                Rule::unique('wahana')->ignore($this->id)
            ],
            'description' => 'required',
            'max_person' => 'required',
            'room_wide' => 'required',
            'room_available' => 'required',
            'room_name' => [
                'required',
                Rule::unique('wahana')->ignore($this->id)
            ],
            'price' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nama wahana tidak boleh kosong',
            'name.unique' => 'Nama wahana sudah ada',
            'description.required' => 'Deskripsi wahana tidak boleh kosong',
            'max_person.required' => 'Max. jumlah peserta tidak boleh kosong',
            'room_available.required' => 'Jumlah tenda/kamar tidak boleh kosong',
            'room_name.required' => 'Nama tenda/kamar tidak boleh kosong',
            'room_name.unique' => 'Nama tenda/kamar sudah digunakan untuk wahana yang lain',
            'price.required' => 'Harga tidak boleh kosong',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'msg_title' => 'Gagal',
            'msg_body' => json_encode($validator->errors())
        ], 422));
    }
}
