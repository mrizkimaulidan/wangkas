<?php

namespace App\Livewire\SchoolMajors;

use App\Models\SchoolMajor;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchoolMajor extends Component
{
    public SchoolMajor $schoolMajor;

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-majors.delete-school-major');
    }

    /**
     * Set the value based on the given ID.
     */
    #[On('school-major-delete')]
    public function setValue(int $id): void
    {
        $this->schoolMajor = SchoolMajor::find($id);
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        $this->schoolMajor->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-major-deleted')->to(SchoolMajorTable::class);
    }
}
