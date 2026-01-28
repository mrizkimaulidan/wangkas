<?php

use App\Livewire\Forms\StoreCashTransactionForm;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tambah Data Kas')] class extends Component
{
    public StoreCashTransactionForm $form;

    public Collection $students;

    public Collection $schoolClasses;

    public Collection $schoolMajors;

    /**
     * Initialize component with data
     */
    public function mount(): void
    {
        $this->form->date_paid = now()->toDateString();

        // TODO: should be dynamic from logged in user ID
        $this->form->created_by = User::inRandomOrder()->first()->id;

        $this->students = Student::orderBy('name')->get();
        $this->schoolClasses = SchoolClass::orderBy('name')->get();
        $this->schoolMajors = SchoolMajor::orderBy('name')->get();
    }

    /**
     * Process form submission for creating data
     */
    public function save(): void
    {
        $this->form->store();

        session()->flash('success', 'Data kas berhasil ditambahkan!');

        $this->redirectRoute('kas.index', navigate: true);
    }
};
