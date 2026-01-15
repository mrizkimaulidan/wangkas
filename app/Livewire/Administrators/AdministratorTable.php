<?php

namespace App\Livewire\Administrators;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Administrator')]
class AdministratorTable extends Component
{
    use WithPagination;

    private const DEFAULT_LIMIT = 5;

    private const DEFAULT_SORT_COLUMN = 'name';

    private const DEFAULT_SORT_ORDER = 'asc';

    private const VALID_LIMITS = [5, 10, 15, 20, 25];

    private const VALID_SORT_COLUMNS = ['name', 'email', 'created_at'];

    private const VALID_SORT_ORDERS = ['asc', 'desc'];

    public string $search = '';

    public int $perPage = self::DEFAULT_LIMIT;

    public string $sortBy = self::DEFAULT_SORT_COLUMN;

    public string $sortOrder = self::DEFAULT_SORT_ORDER;

    /**
     * Mount method - runs once when component is first rendered
     */
    public function mount(): void
    {
        // Initialization code if needed
    }

    /**
     * Updated hook - called when any property changes
     */
    public function updated(string $property): void
    {
        $this->validateProperty($property);
        $this->resetPage();
    }

    /**
     * Validate a single property silently
     */
    private function validateProperty(string $property): void
    {
        // Create validator for the specific property
        $validator = Validator::make(
            [$property => $this->{$property}],
            $this->getValidationRules($property)
        );

        // If validation fails, reset property to default value
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
    #[On(['administrator-created', 'administrator-updated', 'administrator-deleted'])]
    public function render(): View
    {
        $administrators = User::query()
            ->when(
                $this->search,
                fn ($q) => $q->search($this->search)
            )
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->perPage);

        return view('livewire.administrators.administrator-table', [
            'administrators' => $administrators,
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
