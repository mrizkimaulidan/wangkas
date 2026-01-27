<?php

use App\Livewire\Forms\StoreStudentForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Pelajar')] class extends Component
{
    public StoreStudentForm $form;

    public Collection $schoolMajors;

    public Collection $schoolClasses;

    /**
     * Initialize component with data
     */
    public function mount(): void
    {
        $currentYear = now()->year;

        $this->schoolMajors = SchoolMajor::orderBy('name')->get();
        $this->schoolClasses = SchoolClass::orderBy('name')->get();

        $this->form->school_year_start = $currentYear;
        $this->form->school_year_end = $currentYear + 3;
    }

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();

        session()->flash('success', 'Data pelajar berhasil ditambahkan!');

        $this->redirectRoute('pelajar.index');
    }
};
