<?php

namespace App\Livewire\Students;

use App\Livewire\Forms\StoreStudentForm;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateStudent extends Component
{
    public StoreStudentForm $form;

    public Collection $schoolClasses;

    public Collection $schoolMajors;

    /**
     * Initialize the component's state.
     */
    public function mount(): void
    {
        $year = now()->year;

        $this->form->school_year_start = $year;
        $this->form->school_year_end = $year + 3;
    }

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.students.create-student', [
            'schoolClasses' => $this->schoolClasses,
            'schoolMajors' => $this->schoolMajors,
        ]);
    }

    /**
     * Save the form data and handle the related events.
     */
    public function save(): void
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('student-created')->to(StudentTable::class);
    }
}
