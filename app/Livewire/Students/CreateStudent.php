<?php

namespace App\Livewire\Students;

use App\Livewire\Forms\StoreStudentForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Livewire\Component;

class CreateStudent extends Component
{
    public StoreStudentForm $form;

    public function render()
    {
        $schoolClasses = SchoolClass::all();
        $schoolMajors = SchoolMajor::all();

        return view('livewire.students.create-student', [
            'schoolClasses' => $schoolClasses,
            'schoolMajors' => $schoolMajors
        ]);
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('school-major-created')->to(StudentTable::class);
    }
}
