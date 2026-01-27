<?php

use App\Models\SchoolClass;
use Livewire\Component;

new class extends Component
{
    public SchoolClass $schoolClass;

    /**
     * Initialize component with data
     */
    public function mount(SchoolClass $schoolClass): void
    {
        $this->schoolClass = $schoolClass;
    }

    /**
     * Process data deletion
     */
    public function destroy(): void
    {
        $this->schoolClass->delete();

        session()->flash('success', 'Data kelas berhasil dihapus!');

        $this->redirectRoute('kelas.index', navigate: true);
    }
};
