<?php

namespace App\Livewire\SchoolMajors;

use App\Livewire\Forms\StoreSchoolMajorForm;
use Livewire\Component;

class CreateSchoolMajor extends Component
{
    public StoreSchoolMajorForm $form;

    public function render()
    {
        return view('livewire.school-majors.create-school-major');
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('school-major-created')->to(SchoolMajorTable::class);
    }
}
