<?php

use App\Livewire\Forms\CreateSchoolClassForm;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Kelas')] class extends Component
{
    public CreateSchoolClassForm $form;

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();
        $this->redirect('/kelas', navigate: true);
    }
};
