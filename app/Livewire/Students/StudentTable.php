<?php

namespace App\Livewire\Students;

use App\Models\SchoolClass;
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

    #[On('student-created')]
    #[On('student-updated')]
    #[On('student-deleted')]
    public function render()
    {
        $students = Student::query()
            ->when($this->query, function (Builder $query) {
                $this->resetPage();
                return $query->where('name', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.students.student-table', [
            'students' => $students,
        ]);
    }

    public function resetFilter()
    {
        $this->reset([
            'query',
            'limit',
            'orderByColumn',
            'orderBy',
        ]);
    }
}