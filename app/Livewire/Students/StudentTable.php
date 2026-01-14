<?php

namespace App\Livewire\Students;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Pelajar')]
class StudentTable extends Component
{
    use WithPagination;

    protected StudentRepository $studentRepository;

    public $schoolClasses;

    public $schoolMajors;

    public $studentGenders;

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'name';

    public string $orderBy = 'asc';

    public array $filters = [
        'schoolClassID' => '',
        'schoolMajorID' => '',
        'gender' => '',
    ];

    public function boot(StudentRepository $studentRepository): void
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Mount method - runs once when component is first rendered
     * Fetches initial data that doesn't change frequently
     */
    public function mount(): void
    {
        $this->schoolClasses = SchoolClass::all();
        $this->schoolMajors = SchoolMajor::all();
    }

    /**
     * Updated hook - automatically called when any property value changes
     * Validates the changed property and resets pagination
     *
     * @param  string  $property  The name of the property that was updated
     */
    public function updated(string $property): void
    {
        // Validate the changed property
        $this->validateProperty($property);

        // Reset to first page when filters or sorting changes
        $this->resetPage();
    }

    /**
     * Validates a single property using Laravel Validator
     * Silently resets invalid values to defaults (no error messages shown)
     *
     * @param  string  $property  Property name to validate
     */
    private function validateProperty(string $property): void
    {
        // Create validator for the specific property
        $validator = Validator::make(
            [$property => $this->{$property}], // Data to validate
            $this->getValidationRules($property) // Validation rules
        );

        // If validation fails, reset property to default value
        if ($validator->fails()) {
            $this->resetPropertyToDefault($property);
        }
    }

    /**
     * Returns validation rules for specific properties
     * Used by validateProperty() method
     *
     * @param  string  $property  Property name
     * @return array Validation rules array
     */
    private function getValidationRules(string $property): array
    {
        return match ($property) {
            'limit' => ['limit' => ['required', 'integer', 'in:5,10,15,20,25']],
            'orderByColumn' => ['orderByColumn' => ['in:name,created_at,updated_at']],
            'orderBy' => ['orderBy' => ['in:asc,desc']],
            'filters.gender' => ['filters.gender' => ['nullable', 'in:male,female,other']],
            default => [], // No validation for other properties
        };
    }

    /**
     * Resets a property to its default value
     * Called when validation fails
     *
     * @param  string  $property  Property name to reset
     */
    private function resetPropertyToDefault(string $property): void
    {
        match ($property) {
            'limit' => $this->limit = 5,
            'orderByColumn' => $this->orderByColumn = 'name',
            'orderBy' => $this->orderBy = 'asc',
            'filters.gender' => $this->filters['gender'] = '',
            default => null,
        };
    }

    /**
     * Render method - builds and returns the view
     * Called automatically by Livewire when data changes
     * Listens for student CRUD events to refresh data
     */
    #[On(['student-created', 'student-updated', 'student-deleted'])]
    public function render(): View
    {
        $students = Student::query()
            ->when(
                $this->filters['schoolClassID'],
                fn ($q) => $q->where('school_class_id', (int) $this->filters['schoolClassID'])
            )
            ->when(
                $this->filters['schoolMajorID'],
                fn ($q) => $q->where('school_major_id', (int) $this->filters['schoolMajorID'])
            )
            ->when($this->filters['gender'], fn ($q) => $q->where('gender', $this->filters['gender']))
            ->when($this->query, fn ($q) => $q->search($this->query))
            ->with('schoolClass', 'schoolMajor')
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        $this->studentGenders = $this->studentRepository->countStudentGender();

        return view('livewire.students.student-table', [
            'students' => $students,
        ]);
    }

    /**
     * Reset all filters, sorting, and search to default values
     * Also resets pagination to first page
     */
    public function resetFilter(): void
    {
        // Reset all filter-related properties
        $this->reset(['query', 'limit', 'orderByColumn', 'orderBy', 'filters']);

        // Return to first page
        $this->resetPage();
    }
}
