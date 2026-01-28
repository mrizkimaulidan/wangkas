<?php

use App\Models\CashTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Halaman Kas Minggu Ini')] class extends Component
{
    use WithPagination;

    /**
     * Number of items per page
     * Persisted in URL
     */
    #[Url]
    public int $perPage = 5;

    /**
     * Search query for filtering
     * Persisted in URL
     */
    #[Url]
    public string $search = '';

    /**
     * Current sorting configuration
     * Persisted in URL
     */
    #[Url]
    public string $sortBy = 'newest';

    /**
     * Get paginated list with filters and sorting
     */
    #[Computed]
    public function cashTransactions(): LengthAwarePaginator
    {
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d');

        return CashTransaction::query()
            ->with([
                'student.schoolMajor',
                'student.schoolClass',
                'createdBy',
            ])
            ->when($this->search, function (Builder $query) {
                $query->search((string) $this->search);
            })
            ->when($this->sortBy, function (Builder $query) {
                $query->sort((string) $this->sortBy);
            })
            ->whereBetween('date_paid', [$startOfWeek, $endOfWeek])
            ->paginate((int) $this->perPage);
    }

    /**
     * Reset all filters to default values
     */
    public function resetFilters(): void
    {
        $this->reset(['perPage', 'search', 'sortBy']);
        $this->resetPage();
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
};
