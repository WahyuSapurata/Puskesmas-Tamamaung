<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendataanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_bayi' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'tgl_lahir_bayi' => 'required',
            'tgl_pengecekan' => 'required',
            'tb' => 'required',
            'bb' => 'required',
            'jkel' => 'required',
        ];
    }
}
