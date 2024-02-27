<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
            'title' => [
                'required',
                Rule::unique('articles')->ignore($this->id)
            ],
            'category_id' => 'required',
            'content' => 'required',
            'status' => 'required',
            'tags' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Nama produk tidak boleh kosong',
            'title.unique' => 'Sudah ada artikel dengan judul serupa',
            'category_id.required' => 'Kategori tidak boleh kosong',
            'content.required' => 'Konten tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'tags.required' => 'Tags tidak boleh kosong',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'msg_title' => 'Gagal',
            'msg_body' => json_encode($validator->errors())
        ], 422));
    }
}
