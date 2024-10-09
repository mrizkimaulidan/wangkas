<?php

namespace App\Livewire\Administrators;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Administrator')]
class AdministratorTable extends Component
{
    use WithPagination;

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'name';

    public string $orderBy = 'asc';

    #[On('administrator-created')]
    public function render()
    {
        $administrators = User::query()
            ->when($this->query, function (Builder $query) {
                $this->resetPage();

                return $query->where('name', 'like', "%{$this->query}%")
                    ->orWhere('email', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        return view('livewire.administrators.administrator-table', [
            'administrators' => $administrators,
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
