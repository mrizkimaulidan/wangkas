<?php

namespace App\Livewire\Administrators;

use App\Livewire\Forms\StoreAdministratorForm;
use Livewire\Component;

class CreateAdministrator extends Component
{
    public StoreAdministratorForm $form;

    public function render()
    {
        return view('livewire.administrators.create-administrator');
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('administrator-created')->to(AdministratorTable::class);
    }
}
