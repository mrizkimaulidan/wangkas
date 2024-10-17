<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateProfileForm;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Pengaturan Profil')]
class UpdateProfile extends Component
{
    public UpdateProfileForm $form;

    /**
     * Initialize the component's state.
     */
    public function mount(): void
    {
        $user = auth()->guard()->user();

        $this->form->name = $user->name;
        $this->form->email = $user->email;
    }

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.update-profile');
    }

    /**
     * Update the form data and handle the related events.
     */
    public function edit(): void
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('profile-updated')->to(UpdateProfile::class);
    }
}
