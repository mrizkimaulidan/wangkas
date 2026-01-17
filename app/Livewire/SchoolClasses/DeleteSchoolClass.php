<?php

namespace App\Livewire\SchoolClasses;

use App\Models\SchoolClass;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchoolClass extends Component
{
    public $schoolClass;

    public bool $isBatchDelete = false;

    public array $selectedIDs = [];

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.school-classes.delete-school-class');
    }

    /**
     * Set the specified model instance for the component.
     */
    #[On('school-class-delete')]
    public function setValue($schoolClass): void
    {
        // Handle batch delete
        if (is_array($schoolClass)) {
            $this->isBatchDelete = true;
            $this->selectedIDs = $schoolClass;
            $this->schoolClass = null;
        } else {
            $this->isBatchDelete = false;
            $this->selectedIDs = [];
            $this->schoolClass = $schoolClass;
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
        $schoolClasses = SchoolClass::whereIn('id', $this->selectedIDs)->get();

        $warnings = $schoolClasses->filter(fn ($c) => $c->students()->exists())->pluck('name')->toArray();
        $deleteableIDs = $schoolClasses->filter(fn ($c) => ! $c->students()->exists())->pluck('id')->toArray();

        foreach ($warnings as $name) {
            $this->dispatch('warning', message: "Data {$name} masih memiliki relasi terhadap pelajar, tidak dapat dihapus!");
        }

        if ($deleteableIDs) {
            SchoolClass::destroy($deleteableIDs);

            $this->dispatch('close-modal');
            $this->dispatch('success', message: $warnings ? 'Sebagian data berhasil dihapus!' : 'Data berhasil dihapus!');
            $this->dispatch('school-class-deleted')->to(\App\Livewire\SchoolClasses\SchoolClassTable::class);
        }
    }

    /**
     * Handle single delete operation.
     */
    protected function singleDelete(): void
    {
        $schoolClass = SchoolClass::find($this->schoolClass);

        if (! $schoolClass) {
            $this->dispatch('close-modal');
            $this->dispatch('warning', message: 'Data tidak ditemukan!');

            return;
        }

        if ($schoolClass->students()->exists()) {
            $message = "Data {$schoolClass->name} masih memiliki relasi terhadap pelajar tidak dapat dihapus!";

            $this->dispatch('close-modal');
            $this->dispatch('warning', message: $message);

            return;
        }

        $schoolClass->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('school-class-deleted')->to(\App\Livewire\SchoolClasses\SchoolClassTable::class);
    }
}
