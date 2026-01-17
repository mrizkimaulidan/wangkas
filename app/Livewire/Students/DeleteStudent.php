<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteStudent extends Component
{
    public $student;

    public bool $isBatchDelete = false;

    public array $selectedIDs = [];

    /**
     * Render the view.
     */
    public function render(): View
    {
        return view('livewire.students.delete-student');
    }

    /**
     * Set the specified model instance for the component.
     */
    #[On('student-delete')]
    public function setValue($student): void
    {
        // Handle batch delete
        if (is_array($student)) {
            $this->isBatchDelete = true;
            $this->selectedIDs = $student;
            $this->student = null;
        } else {
            $this->isBatchDelete = false;
            $this->selectedIDs = [];
            $this->student = $student;
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
        $students = Student::whereIn('id', $this->selectedIDs)->get();

        $warnings = $students->filter(fn ($s) => $s->cashTransactions()->exists())->pluck('name')->toArray();
        $deleteableIDs = $students->filter(fn ($s) => ! $s->cashTransactions()->exists())->pluck('id')->toArray();

        foreach ($warnings as $name) {
            $this->dispatch('warning', message: "Data {$name} masih memiliki relasi terhadap transaksi, tidak dapat dihapus!");
        }

        if ($deleteableIDs) {
            Student::destroy($deleteableIDs);

            $this->dispatch('close-modal');
            $this->dispatch('success', message: $warnings ? 'Sebagian data berhasil dihapus!' : 'Data berhasil dihapus!');
            $this->dispatch('student-deleted')->to(\App\Livewire\Students\StudentTable::class);
        }
    }

    /**
     * Handle single delete operation.
     */
    protected function singleDelete(): void
    {
        $student = Student::find($this->student);

        if (! $student) {
            $this->dispatch('close-modal');
            $this->dispatch('warning', message: 'Data tidak ditemukan!');

            return;
        }

        if ($student->cashTransactions()->exists()) {
            $message = "Data {$student->name} masih memiliki relasi terhadap transaksi tidak dapat dihapus!";

            $this->dispatch('close-modal');
            $this->dispatch('warning', message: $message);

            return;
        }

        $student->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('student-deleted')->to(\App\Livewire\Students\StudentTable::class);
    }
}
