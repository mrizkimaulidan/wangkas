<?php

use App\Models\Student;
use Livewire\Component;

new class extends Component
{
    public Student $student;

    /**
     * Initialize component with data
     */
    public function mount(Student $student): void
    {
        $this->student = $student;
    }

    /**
     * Process data deletion
     */
    public function destroy(): void
    {
        $this->student->delete();

        session()->flash('success', 'Data pelajar berhasil dihapus!');

        $this->redirectRoute('pelajar.index', navigate: true);
    }
};
