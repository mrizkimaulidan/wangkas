<?php

namespace App\Livewire\SchoolMajors;

use App\Models\SchoolMajor;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Jurusan')]
class SchoolMajorTable extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = self::DEFAULT_LIMIT;

    public string $sortBy = self::DEFAULT_SORT_COLUMN;

    public string $sortOrder = self::DEFAULT_SORT_ORDER;

    public array $selectedIDs = [];

    public bool $isSelectAllChecked = false;

    private const DEFAULT_LIMIT = 5;

    private const DEFAULT_SORT_COLUMN = 'name';

    private const DEFAULT_SORT_ORDER = 'asc';

    private const VALID_LIMITS = [5, 10, 15, 20, 25];

    private const VALID_SORT_COLUMNS = ['name', 'created_at'];

    private const VALID_SORT_ORDERS = ['asc', 'desc'];

    /**
     * Handle select all checkbox state change
     */
    public function updatedisSelectAllChecked(bool $value): void
    {
        $this->selectedIDs = $value ? $this->getFilteredSchoolMajorQuery()->pluck('id')->toArray() : [];
    }

    /**
     * Get filtered query based on current filters
     */
    private function getFilteredSchoolMajorQuery()
    {
        return SchoolMajor::query()
            ->when(
                $this->search,
                fn ($q) => $q->search($this->search)
            );
    }

    /**
     * Check if all items are selected
     */
    #[Computed]
    public function isAllSelected(): bool
    {
        if (empty($this->selectedIDs)) {
            return false;
        }

        return $this->validSelectedCount === $this->getFilteredSchoolMajorQuery()->count();
    }

    /**
     * Get valid selected IDs that exist in database
     */
    #[Computed]
    public function validSelectedIDs(): array
    {
        return SchoolMajor::whereIn('id', $this->selectedIDs)
            ->pluck('id')
            ->toArray();
    }

    /**
     * Get count of valid selected items
     */
    #[Computed]
    public function validSelectedCount(): int
    {
        return count($this->validSelectedIDs);
    }

    /**
     * Updated hook - called when any property changes
     */
    public function updated(string $property): void
    {
        $this->validateProperty($property);

        if (in_array($property, ['search', 'perPage', 'sortBy', 'sortOrder'])) {
            $this->resetPage();
        }
    }

    /**
     * Validate a single property silently
     */
    private function validateProperty(string $property): void
    {
        $rules = $this->getValidationRules($property);

        if (empty($rules)) {
            return;
        }

        $validator = Validator::make(
            [$property => $this->{$property}],
            $rules
        );

        if ($validator->fails()) {
            $this->resetPropertyToDefault($property);
        }
    }

    /**
     * Returns validation rules for properties
     */
    private function getValidationRules(string $property): array
    {
        return match ($property) {
            'perPage' => ['perPage' => ['required', 'integer', 'in:'.implode(',', self::VALID_LIMITS)]],
            'sortBy' => ['sortBy' => ['in:'.implode(',', self::VALID_SORT_COLUMNS)]],
            'sortOrder' => ['sortOrder' => ['in:'.implode(',', self::VALID_SORT_ORDERS)]],
            default => [],
        };
    }

    /**
     * Reset property to default value
     */
    private function resetPropertyToDefault(string $property): void
    {
        $this->{$property} = match ($property) {
            'perPage' => self::DEFAULT_LIMIT,
            'sortBy' => self::DEFAULT_SORT_COLUMN,
            'sortOrder' => self::DEFAULT_SORT_ORDER,
            default => $this->{$property},
        };
    }

    /**
     * Render the component
     */
    #[On(['school-major-created', 'school-major-updated', 'school-major-deleted'])]
    public function render(): View
    {
        $schoolMajors = $this->getFilteredSchoolMajorQuery()
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->perPage);

        return view('livewire.school-majors.school-major-table', [
            'schoolMajors' => $schoolMajors,
        ]);
    }

    /**
     * Reset all filters to default values
     */
    public function resetFilters(): void
    {
        $this->reset([
            'search',
            'perPage',
            'sortBy',
            'sortOrder',
        ]);

        $this->resetPage();
    }
}
