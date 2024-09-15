<?php

namespace App\Livewire\SchoolMajors;

use App\Models\SchoolMajor;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchoolMajor extends Component
{
    public SchoolMajor $schoolMajor;

    public function render()
    {
        return view('livewire.school-majors.delete-school-major');
    }

    #[On('school-major-delete')]
    public function setValue(string $id)
    {
        $this->schoolMajor = SchoolMajor::find($id);
    }

    public function destroy()
    {
        $this->schoolMajor->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-major-deleted')->to(SchoolMajorTable::class);
    }
}
