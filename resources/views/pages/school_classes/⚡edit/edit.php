<?php

use App\Livewire\Forms\UpdateSchoolClassForm;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ubah Data Kelas')] class extends Component
{
    public SchoolClass $schoolClass;

    public UpdateSchoolClassForm $form;

    /**
     * Initialize component with data
     */
    public function mount(SchoolClass $schoolClass)
    {
        $schoolClass->loadCount('students');

        $this->form->schoolClass = $schoolClass;
        $this->form->fill($schoolClass);
    }

    /**
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();
        $this->redirect('/kelas', navigate: true);
    }
};
