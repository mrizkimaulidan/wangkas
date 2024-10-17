<?php

namespace App\Livewire\Administrators;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Administrator')]
class AdministratorTable extends Component
{
    use WithPagination;

    public ?string $query = '';

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
    #[On('administrator-created')]
    public function render(): View
    {
        $administrators = User::search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.administrators.administrator-table', [
            'administrators' => $administrators,
        ]);
    }

    /**
     * Reset the filter criteria to default values.
     */
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
