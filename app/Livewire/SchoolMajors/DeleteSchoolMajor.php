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
     * Set the specified model instance for the component.
     */
    #[On('school-major-delete')]
    public function setValue(SchoolMajor $schoolMajor): void
    {
        $this->schoolMajor = $schoolMajor;
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        if ($this->schoolMajor->students()->exists()) {
            $this->dispatch('close-modal');
            $this->dispatch('warning', message: 'Data masih memiliki relasi terhadap pelajar tidak dapat dihapus!');

            return;
        }

        $this->schoolMajor->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-major-deleted')->to(SchoolMajorTable::class);
    }
}
