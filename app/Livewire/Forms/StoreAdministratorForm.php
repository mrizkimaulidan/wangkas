<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreAdministratorForm extends Form
{
    #[Validate]
    public ?string $name;

    public ?string $email;

    public ?string $password;

    public ?string $password_confirmation;

    /**
     * Store a newly created resource in storage.
     */
    public function store(): void
    {
        $this->validate();

        User::create($this->pull());
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->numbers(),
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
            'email.unique' => 'Alamat email sudah terdaftar!',

            'password.required' => 'Kata sandi tidak boleh kosong!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok!',
            'password.min' => 'Kata sandi harus minimal :min karakter!',
            'password.numbers' => 'Kata sandi harus berisi minimal 1 angka!',
        ];
    }
}
