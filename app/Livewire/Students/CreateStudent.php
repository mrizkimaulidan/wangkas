<?php

namespace App\Livewire\Students;

use App\Livewire\Forms\StoreStudentForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateStudent extends Component
{
    public StoreStudentForm $form;
    public Collection $schoolClasses;
    public Collection $schoolMajors;

    public function render()
    {
        return view('livewire.students.create-student', [
            'schoolClasses' => $this->schoolClasses,
            'schoolMajors' => $this->schoolMajors,
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
