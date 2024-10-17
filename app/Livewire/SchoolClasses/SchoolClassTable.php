<?php

namespace App\Livewire\SchoolClasses;

use App\Models\SchoolClass;
use Illuminate\Contracts\View\View;
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
    #[On('school-class-created')]
    #[On('school-class-updated')]
    #[On('school-class-deleted')]
    public function render(): View
    {
        $schoolClasses = SchoolClass::search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.school-classes.school-class-table', [
            'schoolClasses' => $schoolClasses,
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
