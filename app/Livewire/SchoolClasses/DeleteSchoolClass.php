<?php

namespace App\Livewire\SchoolClasses;

use App\Models\SchoolClass;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchoolClass extends Component
{
    public SchoolClass $schoolClass;

    public function render()
    {
        return view('livewire.school-classes.delete-school-class');
    }

    #[On('school-class-delete')]
    public function setValue(string $id)
    {
        $this->schoolClass = SchoolClass::find($id);
    }

    public function destroy()
    {
        $this->schoolClass->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-class-deleted')->to(SchoolClassTable::class);
    }
}
