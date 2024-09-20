<?php

namespace App\Livewire\SchoolClasses;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Kelas')]
class SchoolClassTable extends Component
{
    use WithPagination;

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'name';

    public string $orderBy = 'asc';

    #[On('school-class-created')]
    #[On('school-class-updated')]
    #[On('school-class-deleted')]
    public function render()
    {
        $schoolClasses = SchoolClass::query()
            ->when($this->query, function (Builder $query) {
                $this->resetPage();

                return $query->where('name', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.school-classes.school-class-table', [
            'schoolClasses' => $schoolClasses,
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
