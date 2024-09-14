<?php

namespace App\Livewire\SchoolClasses;

use App\Livewire\Forms\StoreSchoolClassForm;
use Livewire\Component;

class CreateSchoolClass extends Component
{
    public StoreSchoolClassForm $form;

    public function render()
    {
        return view('livewire.school-classes.create-school-class');
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('school-class-created')->to(SchoolClassTable::class);
    }
}
