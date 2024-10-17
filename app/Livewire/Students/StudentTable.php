<?php

namespace App\Livewire\Students;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Pelajar')]
class StudentTable extends Component
{
    use WithPagination;

    public Collection $schoolClasses;

    public Collection $schoolMajors;

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'name';

    public string $orderBy = 'asc';

    public array $filters = [
        'schoolClassID' => '',
        'schoolMajorID' => '',
        'gender' => '',
    ];

    /**
     * Initialize the component's state.
     */
    public function mount(): void
    {
        $this->schoolClasses = SchoolClass::all();
        $this->schoolMajors = SchoolMajor::all();
    }

    /**
     * This method is automatically triggered whenever a property of the component is updated.
     */
    public function updated()
    {
        return $this->resetPage();
    }

    /**
     * Render the view.
     */
    #[On('student-created')]
    #[On('student-updated')]
    #[On('student-deleted')]
    public function render(): View
    {
        $students = Student::query()
            ->when($this->filters['schoolClassID'], function (Builder $query) {
                return $query->where('school_class_id', '=', $this->filters['schoolClassID']);
            })
            ->when($this->filters['schoolMajorID'], function (Builder $query) {
                return $query->where('school_major_id', '=', $this->filters['schoolMajorID']);
            })
            ->when($this->filters['gender'], function (Builder $query) {
                return $query->where('gender', $this->filters['gender']);
            })
            ->search($this->query)
            ->with('schoolClass', 'schoolMajor')
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.students.student-table', [
            'students' => $students,
        ]);
    }

    /**
     * Reset the filter criteria to default values.
     */
    public function resetFilter(): void
    {
        $this->reset([
            'query',
            'limit',
            'orderByColumn',
            'orderBy',
            'filters',
        ]);
    }
}
