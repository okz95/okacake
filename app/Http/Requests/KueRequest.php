<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KueRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|exists:kategoris,id',
            'satuan' => 'required|exists:satuans,id',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
       return[
    'nama.required'     => 'Nama kue wajib diisi.',
    'nama.string'       => 'Nama kue harus berupa teks.',
    'nama.max'          => 'Nama kue maksimal 255 karakter.',

    'harga.required'    => 'Harga kue wajib diisi.',
    'harga.numeric'     => 'Harga kue harus berupa angka.',

    'kategori.required' => 'Kategori wajib dipilih.',
    'kategori.exists'   => 'Kategori yang dipilih tidak ditemukan.',

    'satuan.required'   => 'Satuan wajib dipilih.',
    'satuan.exists'     => 'Satuan yang dipilih tidak ditemukan.',

    'stok.required'     => 'Stok wajib diisi.',
    'stok.numeric'      => 'Stok harus berupa angka.',

    'foto.image'        => 'File yang diunggah harus berupa gambar.',
    'foto.mimes'        => 'Foto harus berformat jpeg, png, atau jpg.',
    'foto.max'          => 'Ukuran foto maksimal 2 MB.',
       ];
    }
}
