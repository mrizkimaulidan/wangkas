<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteStudent extends Component
{
    public Student $student;

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
    public function setValue(Student $student): void
    {
        $this->student = $student;
    }

    /**
     * Remove the specified resource from storage and handle the related events.
     */
    public function destroy(): void
    {
        if ($this->student->cashTransactions()->exists()) {
            $this->dispatch('close-modal');
            $this->dispatch('warning', message: 'Data masih memiliki relasi terhadap transaksi yang ada tidak dapat dihapus!');

            return;
        }

        $this->student->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('student-deleted')->to(StudentTable::class);
    }
}
