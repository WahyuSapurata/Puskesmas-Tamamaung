<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePuskesmasRequest extends FormRequest
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
            'name'      => [
                'required',
                Rule::unique('users'),
                'max:255'
            ],
            'password'      => 'required|confirmed|min:8',
            'email'         => [
                'required',
                'email:rfc,dns',
                Rule::unique('users'),
            ],
            'nip'           => 'required',
            'departemen'    => 'required',
            'no_telp'    => 'required',
        ];
    }
}
