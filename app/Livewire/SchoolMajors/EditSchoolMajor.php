<?php

namespace App\Livewire\SchoolMajors;

use App\Livewire\Forms\UpdateSchoolMajorForm;
use App\Models\SchoolMajor;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSchoolMajor extends Component
{
    public UpdateSchoolMajorForm $form;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-majors.edit-school-major');
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('school-major-edit')]
    public function setValue(int $id): void
    {
        $schoolMajor = SchoolMajor::find($id);
        $this->form->fill($schoolMajor);
    }

    /**
     * Update the form data and handle the related events.
     */
    public function edit(): void
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('school-major-updated')->to(SchoolMajorTable::class);
    }
}
