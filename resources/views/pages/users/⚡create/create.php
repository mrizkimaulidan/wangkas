<?php

use App\Livewire\Forms\StoreUserForm;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Pengguna')] class extends Component
{
    public StoreUserForm $form;

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();
        $this->redirect('/pengguna', navigate: true);
    }
};
