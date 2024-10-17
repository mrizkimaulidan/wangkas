<?php

namespace App\Livewire\Administrators;

use App\Livewire\Forms\StoreAdministratorForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateAdministrator extends Component
{
    public StoreAdministratorForm $form;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.administrators.create-administrator');
    }

    /**
     * Save the form data and handle the related events.
     */
    public function save(): void
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('administrator-created')->to(AdministratorTable::class);
    }
}
