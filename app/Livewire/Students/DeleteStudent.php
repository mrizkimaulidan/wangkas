<?php

namespace App\Livewire\Students;

use Livewire\Component;
use App\Models\Student;
use Livewire\Attributes\On;

class DeleteStudent extends Component
{
    public Student $student;

    public function render()
    {
        return view('livewire.students.delete-student');
    }

    #[On('student-delete')]
    public function setValue(string $id)
    {
        $this->student = Student::find($id);
    }

    public function destroy()
    {
        $this->student->delete();

        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Data berhasil dihapus!');
        $this->dispatch('student-deleted')->to(StudentTable::class);
    }
}
