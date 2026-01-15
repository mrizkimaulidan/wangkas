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

    private const DEFAULT_LIMIT = 5;

    private const DEFAULT_SORT_COLUMN = 'name';

    private const DEFAULT_SORT_ORDER = 'asc';

    private const VALID_LIMITS = [5, 10, 15, 20, 25];

    private const VALID_SORT_COLUMNS = ['identification_number', 'name', 'created_at'];

    private const VALID_SORT_ORDERS = ['asc', 'desc'];

    private const VALID_GENDERS = ['1', '2'];

    protected StudentRepository $studentRepository;

    public $schoolClasses;

    public $schoolMajors;

    public $studentGenders;

    public string $search = '';

    public int $perPage = self::DEFAULT_LIMIT;

    public string $sortBy = self::DEFAULT_SORT_COLUMN;

    public string $sortOrder = self::DEFAULT_SORT_ORDER;

    public string $filterSchoolClassID = '';

    public string $filterSchoolMajorID = '';

    public string $gender = '';

    public function boot(StudentRepository $studentRepository): void
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Mount method - runs once when component is first rendered
     */
    public function mount(): void
    {
        $this->schoolClasses = SchoolClass::all();
        $this->schoolMajors = SchoolMajor::all();
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
            'filterSchoolClassID' => ['filterSchoolClassID' => ['nullable', 'integer', 'exists:school_classes,id']],
            'filterSchoolMajorID' => ['filterSchoolMajorID' => ['nullable', 'integer', 'exists:school_majors,id']],
            'gender' => ['gender' => ['nullable', 'in:'.implode(',', self::VALID_GENDERS)]],
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
            'filterSchoolClassID' => '',
            'filterSchoolMajorID' => '',
            'gender' => '',
            default => $this->{$property},
        };
    }

    /**
     * Render the component
     */
    #[On(['student-created', 'student-updated', 'student-deleted'])]
    public function render(): View
    {
        $students = Student::query()
            ->when(
                $this->filterSchoolClassID,
                fn ($q) => $q->where('school_class_id', (int) $this->filterSchoolClassID)
            )
            ->when(
                $this->filterSchoolMajorID,
                fn ($q) => $q->where('school_major_id', (int) $this->filterSchoolMajorID)
            )
            ->when(
                $this->gender,
                fn ($q) => $q->where('gender', (int) $this->gender)
            )
            ->when(
                $this->search,
                fn ($q) => $q->search($this->search)
            )
            ->with('schoolClass', 'schoolMajor')
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->perPage);

        $this->studentGenders = $this->studentRepository->countStudentGender();

        return view('livewire.students.student-table', [
            'students' => $students,
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
            'filterSchoolClassID',
            'filterSchoolMajorID',
            'gender',
        ]);

        $this->resetPage();
    }
}
