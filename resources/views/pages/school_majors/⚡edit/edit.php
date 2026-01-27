<?php

use App\Livewire\Forms\UpdateSchoolMajorForm;
use App\Models\SchoolMajor;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ubah Data Jurusan')] class extends Component
{
    public SchoolMajor $schoolMajor;

    public UpdateSchoolMajorForm $form;

    /**
     * Initialize component with data
     */
    public function mount(SchoolMajor $schoolMajor)
    {
        $schoolMajor->loadCount('students');

        $this->form->schoolMajor = $schoolMajor;
        $this->form->fill($schoolMajor);
    }

    /**
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();

        session()->flash('success', 'Data jurusan berhasil diubah!');

        $this->redirect('/jurusan', navigate: true);
    }
};
