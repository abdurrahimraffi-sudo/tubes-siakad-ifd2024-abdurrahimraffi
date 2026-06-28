<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $dosenId = $this->route('dosen')?->id;

        return [
            'nidn' => ['required', 'string', 'max:20', 'unique:dosen,nidn,' . $dosenId],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:dosen,email,' . $dosenId],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nama_dosen.required' => 'Nama dosen wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_hp.required' => 'No. HP wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ];
    }
}
