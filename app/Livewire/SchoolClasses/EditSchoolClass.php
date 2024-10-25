<?php

namespace App\Livewire\SchoolClasses;

use App\Livewire\Forms\UpdateSchoolClassForm;
use App\Models\SchoolClass;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class EditSchoolClass extends Component
{
    public UpdateSchoolClassForm $form;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-classes.edit-school-class');
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('school-class-edit')]
    public function setValue(int $id): void
    {
        $schoolClass = SchoolClass::find($id);
        $this->form->fill($schoolClass);
    }

    /**
     * Update the form data and handle the related events.
     */
    public function edit(): void
    {
        $this->form->update();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil diubah!');
        $this->dispatch('school-class-updated')->to(SchoolClassTable::class);
    }
}
