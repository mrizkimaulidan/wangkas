<?php

use App\Livewire\Forms\UpdateStudentForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ubah Data Pelajar')] class extends Component
{
    public Student $student;

    public UpdateStudentForm $form;

    public Collection $schoolMajors;

    public Collection $schoolClasses;

    /**
     * Initialize component with data
     */
    public function mount(Student $student)
    {
        $this->schoolMajors = SchoolMajor::orderBy('name')->get();
        $this->schoolClasses = SchoolClass::orderBy('name')->get();

        $this->form->student = $student;
        $this->form->fill($student);
    }

    /**
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();

        session()->flash('success', 'Data pelajar berhasil diubah!');

        $this->redirectRoute('pelajar.index', navigate: true);
    }
};
