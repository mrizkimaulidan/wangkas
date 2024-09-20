<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateProfileForm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Halaman Pengaturan Profil')]
class UpdateProfile extends Component
{
    public UpdateProfileForm $form;

    public function mount()
    {
        $user = auth()->guard()->user();

        $this->form->name = $user->name;
        $this->form->email = $user->email;
    }

    public function edit()
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('profile-updated')->to(UpdateProfile::class);
    }

    public function render()
    {
        return view('livewire.update-profile');
    }
}
