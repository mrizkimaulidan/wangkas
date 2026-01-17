<?php

namespace App\Livewire\SchoolMajors;

use App\Models\SchoolMajor;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchoolMajor extends Component
{
    public $schoolMajor;

    public bool $isBatchDelete = false;

    public array $selectedIDs = [];

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
    public function setValue($schoolMajor): void
    {
        // Handle batch delete
        if (is_array($schoolMajor)) {
            $this->isBatchDelete = true;
            $this->selectedIDs = $schoolMajor;
            $this->schoolMajor = null; // Clear single schoolMajor when batch deleting
        } else {
            $this->isBatchDelete = false;
            $this->selectedIDs = [];
            $this->schoolMajor = $schoolMajor;
        }
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        if ($this->isBatchDelete) {
            $this->batchDelete();

            return;
        }

        $this->singleDelete();
    }

    /**
     * Handle batch delete operation.
     */
    protected function batchDelete(): void
    {
        $schoolMajors = SchoolMajor::whereIn('id', $this->selectedIDs)->get();

        $warnings = $schoolMajors->filter(fn ($m) => $m->students()->exists())->pluck('name')->toArray();
        $deleteableIDs = $schoolMajors->filter(fn ($m) => ! $m->students()->exists())->pluck('id')->toArray();

        foreach ($warnings as $name) {
            $this->dispatch('warning', message: "Data {$name} masih memiliki relasi terhadap pelajar, tidak dapat dihapus!");
        }

        if ($deleteableIDs) {
            SchoolMajor::destroy($deleteableIDs);

            $this->dispatch('close-modal');
            $this->dispatch('success', message: $warnings ? 'Sebagian data berhasil dihapus!' : 'Data berhasil dihapus!');
            $this->dispatch('school-major-deleted')->to(\App\Livewire\SchoolMajors\SchoolMajorTable::class);
        }
    }

    /**
     * Handle single delete operation.
     */
    protected function singleDelete(): void
    {
        $schoolMajor = SchoolMajor::find($this->schoolMajor);

        if (! $schoolMajor) {
            $this->dispatch('close-modal');
            $this->dispatch('warning', message: 'Data tidak ditemukan!');

            return;
        }

        if ($schoolMajor->students()->exists()) {
            $message = "Data {$schoolMajor->name} masih memiliki relasi terhadap pelajar tidak dapat dihapus!";

            $this->dispatch('close-modal');
            $this->dispatch('warning', message: $message);

            return;
        }

        $schoolMajor->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-major-deleted')->to(\App\Livewire\SchoolMajors\SchoolMajorTable::class);
    }
}
