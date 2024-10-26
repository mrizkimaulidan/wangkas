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
     * Set the specified model instance for the component.
     */
    #[On('student-edit')]
    public function setValue(Student $student): void
    {
        $this->form->student = $student;
        $this->form->fill($student);
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
