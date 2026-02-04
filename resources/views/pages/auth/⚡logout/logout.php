<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    /**
     * Log the user out of the application.
     */
    public function logout(): void
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        session()->flash('success', 'Anda berhasil logout!');

        $this->redirectRoute('login', navigate: true);
    }
};
