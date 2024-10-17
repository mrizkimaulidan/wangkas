<?php

namespace App\Livewire\SchoolMajors;

use App\Models\SchoolMajor;
use Illuminate\Contracts\View\View;
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

    /**
     * This method is automatically triggered whenever a property of the component is updated.
     */
    public function updated(): void
    {
        $this->resetPage();
    }

    /**
     * Render the view.
     */
    #[On('school-major-created')]
    #[On('school-major-updated')]
    #[On('school-major-deleted')]
    public function render(): View
    {
        $schoolMajors = SchoolMajor::search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.school-majors.school-major-table', [
            'schoolMajors' => $schoolMajors,
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
        ]);
    }
}
