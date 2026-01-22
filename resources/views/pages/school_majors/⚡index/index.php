<?php

use App\Models\SchoolMajor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Halaman Daftar Jurusan')] class extends Component
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
    public string $sortBy = 'name_asc';

    /**
     * Get total count of records
     */
    #[Computed]
    public function schoolMajorCount(): int
    {
        return SchoolMajor::count();
    }

    /**
     * Get paginated list with filters and sorting
     */
    #[Computed]
    public function schoolMajors(): LengthAwarePaginator
    {
        return SchoolMajor::query()
            ->when($this->search, function (Builder $q) {
                $q->search((string) $this->search);
            })
            ->when($this->sortBy, function (Builder $q) {
                $q->sort((string) $this->sortBy);
            })
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
