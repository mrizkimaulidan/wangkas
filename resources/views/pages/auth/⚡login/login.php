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
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            $this->redirectRoute('dashboard.index');
        }

        $this->addError('email', 'Alamat email atau kata sandi salah!');
    }
};
