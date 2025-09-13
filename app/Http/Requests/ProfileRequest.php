<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'nama'   => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp'  => ['required', 'string', 'regex:/^[0-9]+$/', 'min:10', 'max:15'],
            'foto'   => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];
    }

    public function messages()
    {
       return[
            'nama.required'   => 'Nama wajib diisi.',
            'nama.max'        => 'Nama maksimal 100 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required'  => 'Nomor HP wajib diisi.',
            'no_hp.regex'     => 'Nomor HP hanya boleh angka.',
            'no_hp.min'       => 'Nomor HP minimal 10 digit.',
            'no_hp.max'       => 'Nomor HP maksimal 15 digit.',
            'foto.image'      => 'File harus berupa gambar.',
            'foto.mimes'      => 'Format gambar hanya boleh jpg, jpeg, atau png.',
            'foto.max'        => 'Ukuran foto maksimal 5 MB.',
       ];
    }
}
