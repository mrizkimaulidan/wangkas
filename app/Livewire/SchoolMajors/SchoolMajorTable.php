<?php

namespace App\Livewire\SchoolMajors;

use App\Models\SchoolMajor;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Jurusan')]
class SchoolMajorTable extends Component
{
    use WithPagination;

    public string $query = '';
    public int $limit = 5;
    public string $orderByColumn = 'name';
    public string $orderBy = 'asc';

    #[On('school-major-created')]
    #[On('school-major-updated')]
    #[On('school-major-deleted')]
    public function render()
    {
        $schoolMajors = SchoolMajor::query()
            ->when($this->query, function (Builder $query) {
                $this->resetPage();
                return $query->where('name', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.school-majors.school-major-table', [
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
        ]);
    }
}
