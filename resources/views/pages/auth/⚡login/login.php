<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts::auth')] #[Title('Halaman Login')] class extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an authentication attempt.
     */
    public function login(): void
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            $this->redirectRoute('dashboard.index');
        }

        $this->addError('email', 'Alamat email atau kata sandi salah!');
    }

    /**
     * Validation rules for the form fields
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'min:1',
                'max:80',
            ],
            'password' => [
                'required',
                'string',
                'max:255',
            ],
            'remember' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages()
    {
        return [
            'email.required' => 'Kolom alamat email harus diisi!',
            'email.string' => 'Kolom alamat email harus berupa teks!',
            'email.email' => 'Format email tidak valid!',
            'email.max' => 'Kolom alamat email minimal :min karakter!',
            'email.max' => 'Kolom alamat email maksimal :max karakter!',

            'password.required' => 'Kolom kata sandi harus diisi!',
            'password.string' => 'Kolom kata sandi harus berupa teks!',
            'password.min' => 'Kolom kata sandi minimal :min karakter!',
            'password.max' => 'Kolom kata sandi maksimal :max karakter!',

            'remember.boolean' => 'Ingat saya harus berupa true atau false',
        ];
    }
};
