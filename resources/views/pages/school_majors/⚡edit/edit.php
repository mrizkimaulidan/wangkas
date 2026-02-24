<?php

use App\Livewire\Forms\UpdateSchoolMajorForm;
use App\Models\SchoolMajor;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Ubah Data Jurusan')] class extends Component
{
    use WithPagination;

    public SchoolMajor $schoolMajor;

    public UpdateSchoolMajorForm $form;

    /**
     * Total count of students related to this school major
     */
    public int $relatedStudentsCount;

    #[Url]
    public string $search = '';

    #[Url]
    public int $perPage = 5;

    /**
     * Initialize component with data
     */
    public function mount(SchoolMajor $schoolMajor)
    {
        $this->relatedStudentsCount = $schoolMajor->loadCount('students')->students_count;

        $this->form->schoolMajor = $schoolMajor;
        $this->form->fill($schoolMajor);
    }

    /**
     * Retrieve all related students based on this school class
     */
    #[Computed]
    public function students()
    {
        return $this->schoolMajor->students()
            ->with('schoolMajor', 'schoolClass')
            ->when($this->search, function (Builder $query) {
                $query->search($this->search);
            })
            ->paginate($this->perPage);
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
