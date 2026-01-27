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

        session()->flash('success', 'Data jurusan berhasil ditambahkan!');

        $this->redirectRoute('jurusan.index', navigate: true);
    }
};
