<?php

use App\Livewire\Forms\UpdateSchoolClassForm;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Ubah Data Kelas')] class extends Component
{
    use WithPagination;

    public SchoolClass $schoolClass;

    public UpdateSchoolClassForm $form;

    /**
     * Total count of students related to this school class
     */
    public int $relatedStudentsCount;

    #[Url]
    public string $search = '';

    #[Url]
    public int $perPage = 5;

    /**
     * Initialize component with data
     */
    public function mount(SchoolClass $schoolClass)
    {
        $this->relatedStudentsCount = $schoolClass->loadCount('students')->students_count;

        $this->form->schoolClass = $schoolClass;
        $this->form->fill($schoolClass);
    }

    /**
     * Retrieve all related students based on this school class
     */
    #[Computed]
    public function students()
    {
        return $this->schoolClass->students()
            ->with('schoolMajor', 'schoolClass')
            ->when($this->search, function (Builder $query) {
                $query->search($this->search);
            })
            ->paginate($this->perPage);
    }

    /**
     * Handle property updates
     */
    public function updated(string $property): void
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    /**
     * Process form submission for updating data
     */
    public function update(): void
    {
        $this->form->update();

        session()->flash('success', 'Data kelas berhasil diubah');

        $this->redirectRoute('kelas.index', navigate: true);
    }
};
