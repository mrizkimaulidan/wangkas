<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProfileForm extends Form
{
    public User $user;

    #[Validate]
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Update data to database
     */
    public function update(): void
    {
        $this->validate();

        $data = $this->only(['name', 'email', 'password']);

        // Check if password is filled (not empty string)
        if (filled($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Remove if empty
        }

        $this->user->update($data);
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
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'password' => [
                'nullable',
                'string',
                'max:255',
                'confirmed',
                Password::min(8)->numbers(),
            ],
            'password_confirmation' => [
                'required_with:password',
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

            'password.min' => 'Kolom kata sandi minimal :min karakter!',
            'password.max' => 'Kolom kata sandi maksimal :max karakter!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',

            'password_confirmation.required_with' => 'Kolom konfirmasi kata sandi harus diisi!',
            'password_confirmation.string' => 'Kolom konfirmasi kata sandi harus berupa teks!',
            'password_confirmation.min' => 'Kolom konfirmasi kata sandi minimal :min karakter!',
            'password_confirmation.max' => 'Kolom konfirmasi kata sandi maksimal :max karakter!',
        ];
    }
}
