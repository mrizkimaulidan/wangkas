<?php

use App\Livewire\Forms\StoreSchoolClassForm;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Kelas')] class extends Component
{
    public StoreSchoolClassForm $form;

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();
        $this->redirect('/kelas', navigate: true);
    }
};
