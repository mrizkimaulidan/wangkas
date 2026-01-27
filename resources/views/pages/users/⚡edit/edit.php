<?php

use App\Livewire\Forms\UpdateUserForm;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ubah Data Pengguna')] class extends Component
{
    public User $user;

    public UpdateUserForm $form;

    public bool $showPassword = false;

    /**
     * Initialize component with data
     */
    public function mount(User $user)
    {
        $this->form->user = $user;
        $this->form->fill($user);
    }

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
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();

        session()->flash('success', 'Data pengguna berhasil diubah!');

        $this->redirect('/pengguna', navigate: true);
    }
};
