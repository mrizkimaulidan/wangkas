<?php

namespace App\Livewire\SchoolClasses;

use App\Models\SchoolClass;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchoolClass extends Component
{
    public SchoolClass $schoolClass;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-classes.delete-school-class');
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('school-class-delete')]
    public function setValue(int $id): void
    {
        $this->schoolClass = SchoolClass::find($id);
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        $this->schoolClass->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-class-deleted')->to(SchoolClassTable::class);
    }
}
