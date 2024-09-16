<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreAdministratorForm extends Form
{
    #[Validate]
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function store()
    {
        $this->validate();

        User::create($this->pull());
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'password' => 'required|confirmed|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama lengkap tidak boleh kosong!',
            'name.min' => 'Kolom nama lengkap minimal :min karakter!',
            'name.max' => 'Kolom nama lengkap maksimal :max karakter!',

            'email.required' => 'Kolom alamat email tidak boleh kosong!',
            'email.email' => 'Kolom alamat email bukan email yang valid!',
            'email.min' => 'Kolom alamat email minimal :min karakter!',
            'email.max' => 'Kolom alamat email maksimal :max karakter!',

            'password.required' => 'Kolom kata sandi tidak boleh kosong!',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai!',
            'password.min' => 'Kolom kata sandi minimal :min karakter!',
            'password.max' => 'Kolom kata sandi maksimal :max karakter!',

        ];
    }
}
