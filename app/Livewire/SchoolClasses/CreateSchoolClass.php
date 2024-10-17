<?php

namespace App\Livewire\SchoolClasses;

use App\Livewire\Forms\StoreSchoolClassForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateSchoolClass extends Component
{
    public StoreSchoolClassForm $form;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-classes.create-school-class');
    }

    /**
     * Save the form data and handle the related events.
     */
    public function save(): void
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('school-class-created')->to(SchoolClassTable::class);
    }
}
