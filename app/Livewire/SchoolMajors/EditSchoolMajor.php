<?php

namespace App\Livewire\SchoolMajors;

use App\Livewire\Forms\UpdateSchoolMajorForm;
use App\Models\SchoolMajor;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSchoolMajor extends Component
{
    public UpdateSchoolMajorForm $form;

    public function render()
    {
        return view('livewire.school-majors.edit-school-major');
    }

    #[On('school-major-edit')]
    public function setValue(string $id)
    {
        $schoolMajor = SchoolMajor::find($id);
        $this->form->id = $schoolMajor->id;
        $this->form->name = $schoolMajor->name;
        $this->form->abbreviation = $schoolMajor->abbreviation;
    }

    public function edit()
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('school-major-updated')->to(SchoolMajorTable::class);
    }
}
