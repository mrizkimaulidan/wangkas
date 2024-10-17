<?php

namespace App\Livewire\Students;

use App\Livewire\Forms\UpdateStudentForm;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class EditStudent extends Component
{
    public UpdateStudentForm $form;

    public Collection $schoolClasses;

    public Collection $schoolMajors;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.students.edit-student', [
            'schoolClasses' => $this->schoolClasses,
            'schoolMajors' => $this->schoolMajors,
        ]);
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('student-edit')]
    public function setValue(int $id): void
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

    /**
     * Update the form data and handle the related events.
     */
    public function edit(): void
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('student-updated')->to(StudentTable::class);
    }
}
