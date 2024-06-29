<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email,' . auth()->id(),
            'current_password' => 'nullable|current_password',
            'password' => 'nullable|min:3|max:255|confirmed',
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
            'name.required' => 'Kolom nama lengkap tidak boleh kosong!',
            'name.min' => 'Kolom nama lengkap minimal harus 3 karakter!',
            'name.max' => 'Kolom nama lengkap maksimal adalah 255 karakter!',
            'email.required' => 'Kolom email tidak boleh kosong!',
            'email.email' => 'Format email tidak valid!',
            'email.min' => 'Kolom email minimal harus 3 karakter!',
            'email.max' => 'Kolom email maksimal adalah 255 karakter!',
            'email.unique' => 'Email sudah digunakan!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
            'password.min' => 'Kolom password minimal harus 3 karakter!',
            'password.max' => 'Kolom password maksimal adalah 255 karakter!',
            'current_password.current_password' => 'Kata sandi saat ini tidak benar!'
        ];
    }
}
