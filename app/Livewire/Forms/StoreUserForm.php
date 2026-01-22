<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreUserForm extends Form
{
    #[Validate]
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Save new data to database
     */
    public function store(): void
    {
        $this->validate();

        User::create($this->only('name', 'email', 'password'));

        $this->reset();
    }

    /**
     * Validation rules for the form fields
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'max:255',
                'confirmed',
                Password::min(8)
                    ->numbers(),
            ],
            'password_confirmation' => [
                'required',
                'string',
                'same:password',
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama lengkap harus diisi!',
            'name.string' => 'Kolom nama lengkap harus berupa teks!',
            'name.min' => 'Kolom nama lengkap minimal :min karakter!',
            'name.max' => 'Kolom nama lengkap maksimal :max karakter!',

            'email.required' => 'Kolom alamat email harus diisi!',
            'email.string' => 'Kolom alamat email harus berupa teks!',
            'email.email' => 'Format email tidak valid!',
            'email.max' => 'Kolom alamat email maksimal :max karakter!',
            'email.unique' => 'Alamat email sudah digunakan!',

            'password.required' => 'Kolom kata sandi harus diisi!',
            'password.string' => 'Kolom kata sandi harus berupa teks!',
            'password.min' => 'Kolom kata sandi minimal :min karakter!',
            'password.max' => 'Kolom kata sandi maksimal :max karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
            'password.numbers' => 'Kata sandi harus mengandung angka!',

            'password_confirmation.required' => 'Kolom konfirmasi kata sandi harus diisi!',
            'password_confirmation.string' => 'Kolom konfirmasi kata sandi harus berupa teks!',
            'password_confirmation.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi!',
        ];
    }
}
