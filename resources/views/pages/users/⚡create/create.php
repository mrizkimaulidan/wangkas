<?php

use App\Livewire\Forms\StoreUserForm;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Pengguna')] class extends Component
{
    public StoreUserForm $form;

    public bool $showPassword = false;

    /**
     * Toggle password visibility
     */
    public function togglePasswordVisibility(): void
    {
        $this->showPassword = ! $this->showPassword;
    }

    /**
     * Generate a secure random password using Laravel's built-in functions
     *
     * This method generates a cryptographically secure random password
     * that includes letters, numbers, and symbols.
     */
    public function generatePassword(): void
    {
        $generatedPassword = Str::password(12);
        $this->form->password = $generatedPassword;
        $this->form->password_confirmation = $generatedPassword;
    }

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();
        $this->redirect('/pengguna', navigate: true);
    }
};
