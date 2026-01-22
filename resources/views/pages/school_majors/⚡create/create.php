<?php

use App\Livewire\Forms\StoreSchoolMajorForm;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Jurusan')] class extends Component
{
    public StoreSchoolMajorForm $form;

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();
        $this->redirect('/jurusan', navigate: true);
    }
};
