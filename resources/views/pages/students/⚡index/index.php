<?php

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Halaman Pelajar')] class extends Component
{
    use WithPagination;

    #[Url]
    public string $gender = '';

    #[Url]
    public int $perPage = 5;

    #[Url]
    public string $school_class_id = '';

    #[Url]
    public string $school_major_id = '';

    #[Url]
    public string $search = '';

    #[Url]
    public string $sortBy = 'name_asc';

    /**
     * Retrieve all school majors
     */
    #[Computed]
    public function schoolMajors(): Collection
    {
        return SchoolMajor::withCount('students')->orderBy('name')->get();
    }

    /**
     * Retrieve all school classes
     */
    #[Computed]
    public function schoolClasses(): Collection
    {
        return SchoolClass::withCount('students')->orderBy('name')->get();
    }

    /**
     * Get total count of students
     */
    #[Computed]
    public function studentCount(): int
    {
        return Student::count();
    }

    /**
     * Get total count of female students
     */
    #[Computed]
    public function countFemaleStudent(): int
    {
        return Student::whereGender(2)->count();
    }

    /**
     * Get total count of male students
     */
    #[Computed]
    public function countMaleStudent(): int
    {
        return Student::whereGender(1)->count();
    }

    /**
     * Get paginated list with filters and sorting
     */
    #[Computed]
    public function students(): LengthAwarePaginator
    {
        return Student::query()
            ->with('schoolMajor', 'schoolClass')
            ->when($this->search, fn (Builder $q) => $q->search($this->search))
            ->when($this->sortBy, fn (Builder $q) => $q->sort($this->sortBy))
            ->when($this->school_major_id, fn (Builder $q) => $q->filterBySchoolMajor($this->school_major_id))
            ->when($this->school_class_id, fn (Builder $q) => $q->filterBySchoolClass($this->school_class_id))
            ->when($this->gender, fn (Builder $q) => $q->filterByGender($this->gender))
            ->paginate($this->perPage);
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

    /**
     * Reset all filters to default values
     */
    public function resetFilters(): void
    {
        $this->reset(['perPage', 'search', 'sortBy', 'school_major_id', 'school_class_id', 'gender']);
        $this->resetPage();
    }

    /**
     * Determine whether any filters are currently applied
     */
    public function hasActiveFilters(): bool
    {
        return $this->search || $this->school_major_id || $this->school_class_id || $this->gender;
    }
};
