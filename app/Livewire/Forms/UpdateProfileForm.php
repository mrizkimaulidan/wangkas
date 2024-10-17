<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProfileForm extends Form
{
    #[Validate]
    public ?string $name;

    public ?string $email;

    public ?string $current_password;

    public ?string $password;

    public ?string $password_confirmation;

    /**
     * Update the specified resource in storage.
     */
    public function update(): void
    {
        $this->validate();

        User::find(Auth::id())->update($this->all());

        $this->reset('current_password', 'password', 'password_confirmation');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'current_password' => 'required|current_password|min:3|max:255',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->numbers()->uncompromised(),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap tidak boleh kosong!',
            'name.min' => 'Nama lengkap harus minimal :min karakter!',
            'name.max' => 'Nama lengkap harus maksimal :max karakter!',

            'email.required' => 'Alamat email tidak boleh kosong!',
            'email.email' => 'Alamat email bukan email yang valid!',
            'email.min' => 'Alamat email harus minimal :min karakter!',
            'email.max' => 'Alamat email harus maksimal :max karakter!',

            'password.required' => 'Kata sandi tidak boleh kosong!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
            'password.min' => 'Kata sandi harus minimal :min karakter!',
            'password.numbers' => 'Kata sandi harus berisi minimal 1 angka!',
            'password.uncompromised' => 'Kata sandi ini telah digunakan dalam kebocoran data dan tidak aman!',

            'current_password.required' => 'Kata sandi saat ini tidak boleh kosong!',
            'current_password.min' => 'Kata sandi saat ini harus minimal :min karakter!',
            'current_password.max' => 'Kata sandi saat ini harus maksimal :max karakter!',
            'current_password.current_password' => 'Kata sandi saat ini tidak benar!',
        ];
    }
}
