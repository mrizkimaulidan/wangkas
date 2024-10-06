<?php

namespace App\Livewire\Students;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Pelajar')]
class StudentTable extends Component
{
    use WithPagination;

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'name';

    public string $orderBy = 'asc';

    public array $filters = [
        'schoolClassID' => '',
        'schoolMajorID' => '',
        'gender' => '',
    ];

    #[On('student-created')]
    #[On('student-updated')]
    #[On('student-deleted')]
    public function render()
    {
        $students = Student::query()
            ->with('schoolClass', 'schoolMajor')
            ->when($this->filters['schoolClassID'], function (Builder $query) {
                return $query->where('school_class_id', '=', $this->filters['schoolClassID']);
            })
            ->when($this->filters['schoolMajorID'], function (Builder $query) {
                return $query->where('school_major_id', '=', $this->filters['schoolMajorID']);
            })
            ->when($this->filters['gender'], function (Builder $query) {
                return $query->where('gender', $this->filters['gender']);
            })
            ->when($this->query, function (Builder $query) {
                $this->resetPage();

                return $query->where('identification_number', 'like', "%{$this->query}%")
                    ->orWhereHas('schoolClass', function (Builder $schoolClassQuery) {
                        return $schoolClassQuery->where('name', 'like', "%{$this->query}%");
                    })
                    ->orWhereHas('schoolMajor', function (Builder $schoolMajorQuery) {
                        return $schoolMajorQuery->where('name', 'like', "%{$this->query}%");
                    })
                    ->orWhere('name', 'like', "%{$this->query}%")
                    ->orWhere('school_year_start', 'like', "%{$this->query}%")
                    ->orWhere('school_year_end', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        $schoolClasses = SchoolClass::all();
        $schoolMajors = SchoolMajor::all();

        return view('livewire.students.student-table', [
            'students' => $students,
            'schoolClasses' => $schoolClasses,
            'schoolMajors' => $schoolMajors,
        ]);
    }

    public function resetFilter()
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
