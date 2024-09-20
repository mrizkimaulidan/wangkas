<?php

namespace App\Livewire\SchoolClasses;

use App\Livewire\Forms\UpdateSchoolClassForm;
use App\Models\SchoolClass;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSchoolClass extends Component
{
    public UpdateSchoolClassForm $form;

    public function render()
    {
        return view('livewire.school-classes.edit-school-class');
    }

    #[On('school-class-edit')]
    public function setValue(string $id)
    {
        $schoolClass = SchoolClass::find($id);
        $this->form->id = $schoolClass->id;
        $this->form->name = $schoolClass->name;
    }

    public function edit()
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('school-class-updated')->to(SchoolClassTable::class);
    }
}
