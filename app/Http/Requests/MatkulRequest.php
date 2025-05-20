<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatkulRequest extends FormRequest
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
            'nama_matkul' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
            'angkatan' => 'required|string',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,kelas_id',
        ];
    }
}
