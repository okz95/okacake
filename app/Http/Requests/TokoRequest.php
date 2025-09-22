<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokoRequest extends FormRequest
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
            'nama'    => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'alamat'  => 'required|string',
            'kota'    => 'required|string|max:100',
            'no_hp'   => 'required|string|max:20',
            'fax'     => 'nullable|string|max:20',
            'email'   => 'required|email|max:255',
            'logo'    => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'    => 'Nama toko wajib diisi.',
            'nama.string'      => 'Nama toko harus berupa teks.',
            'nama.max'         => 'Nama toko maksimal 255 karakter.',

            'pemilik.required' => 'Nama pemilik wajib diisi.',
            'pemilik.string'   => 'Nama pemilik harus berupa teks.',
            'pemilik.max'      => 'Nama pemilik maksimal 255 karakter.',

            'alamat.required'  => 'Alamat wajib diisi.',

            'kota.required'    => 'Kota wajib diisi.',
            'kota.string'      => 'Kota harus berupa teks.',
            'kota.max'         => 'Kota maksimal 100 karakter.',

            'no_hp.required'   => 'Nomor HP wajib diisi.',
            'no_hp.string'     => 'Nomor HP harus berupa teks.',
            'no_hp.max'        => 'Nomor HP maksimal 20 karakter.',

            'fax.string'       => 'Fax harus berupa teks.',
            'fax.max'          => 'Fax maksimal 20 karakter.',

            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'email.max'        => 'Email maksimal 255 karakter.',

            'logo.image'       => 'Logo harus berupa file gambar.',
            'logo.mimes'       => 'Logo hanya boleh berformat JPG, JPEG, atau PNG.',
            'logo.max'         => 'Ukuran logo maksimal 5MB.',
        ];
    }
}
