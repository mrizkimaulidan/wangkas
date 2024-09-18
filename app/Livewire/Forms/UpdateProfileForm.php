<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProfileForm extends Form
{
    #[Validate]
    public string $name = '';
    public string $email = '';
    public string $current_password = '';
    public string $password = '';

    public function update()
    {
        $this->validate();

        User::find(auth()->guard()->id())->update($this->all());
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'current_password' => 'required|current_password|min:3|max:255',
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

            'current_password.required' => 'Kolom kata sandi tidak boleh kosong!',
            'current_password.min' => 'Kolom kata sandi minimal :min karakter!',
            'current_password.max' => 'Kolom kata sandi maksimal :max karakter!',
            'current_password.current_password' => 'Kata sandi saat ini tidak benar!'
        ];
    }
}
