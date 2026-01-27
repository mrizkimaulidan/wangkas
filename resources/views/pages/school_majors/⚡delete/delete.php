<?php

use App\Models\SchoolMajor;
use Livewire\Component;

new class extends Component
{
    public SchoolMajor $schoolMajor;

    /**
     * Initialize component with data
     */
    public function mount(SchoolMajor $schoolMajor): void
    {
        $this->schoolMajor = $schoolMajor;
    }

    /**
     * Process data deletion
     */
    public function destroy(): void
    {
        $this->schoolMajor->delete();

        session()->flash('success', 'Data jurusan berhasil dihapus');

        $this->redirectRoute('jurusan.index', navigate: true);
    }
};
