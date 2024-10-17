<?php

namespace App\Livewire\SchoolMajors;

use App\Livewire\Forms\StoreSchoolMajorForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateSchoolMajor extends Component
{
    public StoreSchoolMajorForm $form;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-majors.create-school-major');
    }

    /**
     * Save the form data and handle the related events.
     */
    public function save(): void
    {
        $this->form->store();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil ditambahkan!');
        $this->dispatch('school-major-created')->to(SchoolMajorTable::class);
    }
}
