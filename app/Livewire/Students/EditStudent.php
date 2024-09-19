<?php

namespace App\Livewire\Students;

use App\Livewire\Forms\UpdateStudentForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class EditStudent extends Component
{
    public UpdateStudentForm $form;

    public function render()
    {
        $schoolClasses = SchoolClass::all();
        $schoolMajors = SchoolMajor::all();

        return view('livewire.students.edit-student', [
            'schoolClasses' => $schoolClasses,
            'schoolMajors' => $schoolMajors
        ]);
    }

    #[On('student-edit')]
    public function setValue(string $id)
    {
        $student = Student::find($id);
        $this->form->id = $student->id;
        $this->form->identification_number = $student->identification_number;
        $this->form->name = $student->name;
        $this->form->phone_number = $student->phone_number;
        $this->form->gender = $student->gender;
        $this->form->school_class_id = $student->school_class_id;
        $this->form->school_major_id = $student->school_major_id;
        $this->form->school_year_start = $student->school_year_start;
        $this->form->school_year_end = $student->school_year_end;
    }

    public function edit()
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('student-updated')->to(StudentTable::class);
    }
}
