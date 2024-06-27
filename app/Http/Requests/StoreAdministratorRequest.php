<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministratorRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:3|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama harus diisi!',
            'name.string' => 'Kolom nama harus berupa teks!',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.min' => 'Panjang email minimal :min karakter!',
            'email.max' => 'Panjang email maksimal :max karakter!',
            'email.unique' => 'Email sudah digunakan!',

            'password.required' => 'Kolom password harus diisi!',
            'password.string' => 'Kolom password harus berupa teks!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Panjang password minimal :min karakter!',
            'password.max' => 'Panjang password maksimal :max karakter!',
        ];
    }
}
