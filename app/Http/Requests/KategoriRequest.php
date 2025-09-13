<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'nama'   => ['required', 'string', 'max:100', 'unique:kategoris,nama'],
        ];
    }

    public function messages()
    {
       return[
    'nama.required'     => 'Nama kategori wajib diisi.',
    'nama.string'       => 'Nama kategori harus berupa teks.',
    'nama.max'          => 'Nama kategori maksimal 100 karakter.',
    'nama.unique'       => 'Nama kategori sudah ada dalam sistem.',
       ];
    }
}
