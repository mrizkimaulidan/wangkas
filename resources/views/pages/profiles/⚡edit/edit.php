<?php

use App\Livewire\Forms\UpdateProfileForm;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ubah Profil')] class extends Component
{
    public User $user;

    public UpdateProfileForm $form;

    /**
     * Initialize component with data
     */
    public function mount()
    {
        $user = auth()->user();

        $this->form->user = $user;
        $this->form->fill($user);
    }

    /**
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();

        session()->flash('success', 'Profil berhasil diubah!');

        $this->redirectRoute('profil.edit', navigate: true);
    }
};
