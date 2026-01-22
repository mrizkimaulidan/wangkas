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
        $this->redirect('/jurusan', navigate: true);
    }
};
