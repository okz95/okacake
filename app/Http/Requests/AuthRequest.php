<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'nama' => 'required|string|max:100',
            'username' => 'required|string|unique:users,username|max:50',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ];
    }

public function messages()
{
    return [
        'nama.required' => 'Nama tidak boleh kosong.',
        'nama.string' => 'Nama harus berupa teks.',
        'nama.max' => 'Nama maksimal 100 karakter.',

        'username.required' => 'Username wajib diisi.',
        'username.string' => 'Username harus berupa teks.',
        'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
        'username.max' => 'Username maksimal 50 karakter.',

        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',

        'no_hp.required' => 'Nomor HP wajib diisi.',
        'no_hp.string' => 'Nomor HP harus berupa teks.',
        'no_hp.max' => 'Nomor HP maksimal 15 karakter.',

        'alamat.required' => 'Alamat wajib diisi.',
        'alamat.string' => 'Alamat harus berupa teks.',
        'alamat.max' => 'Alamat maksimal 255 karakter.',

        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ];
}
}
