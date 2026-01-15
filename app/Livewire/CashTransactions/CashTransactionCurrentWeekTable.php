<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Kas Minggu Ini')]
class CashTransactionCurrentWeekTable extends Component
{
    use WithPagination;

    private const DEFAULT_LIMIT = 5;

    private const DEFAULT_SORT_COLUMN = 'date_paid';

    private const DEFAULT_SORT_ORDER = 'desc';

    private const VALID_LIMITS = [5, 10, 15, 20, 25];

    private const VALID_SORT_COLUMNS = ['date_paid', 'amount', 'created_at'];

    private const VALID_SORT_ORDERS = ['asc', 'desc'];

    protected StudentRepository $studentRepository;

    protected CashTransactionRepository $cashTransactionRepository;

    public string $search = '';

    public int $perPage = self::DEFAULT_LIMIT;

    public string $sortBy = self::DEFAULT_SORT_COLUMN;

    public string $sortOrder = self::DEFAULT_SORT_ORDER;

    public ?array $currentWeek = [];

    public string $filterByUserID = '';

    public string $filterBySchoolMajorID = '';

    public string $filterBySchoolClassID = '';

    /**
     * Boot the component.
     */
    public function boot(
        StudentRepository $studentRepository,
        CashTransactionRepository $cashTransactionRepository
    ): void {
        $this->studentRepository = $studentRepository;
        $this->cashTransactionRepository = $cashTransactionRepository;
    }

    /**
     * Initialize the component's state.
     */
    public function mount(): void
    {
        $this->currentWeek['startOfWeek'] = now()->startOfWeek()->format('d-m-Y');
        $this->currentWeek['endOfWeek'] = now()->endOfWeek()->format('d-m-Y');
    }

    #[Computed]
    public function students(): Collection
    {
        return Student::select('id', 'identification_number', 'name')->get();
    }

    #[Computed]
    public function users(): Collection
    {
        return User::select('id', 'name')->orderBy('name')->get();
    }

    #[Computed]
    public function schoolMajors(): Collection
    {
        return SchoolMajor::select('id', 'name')->get();
    }

    #[Computed]
    public function schoolClasses(): Collection
    {
        return SchoolClass::select('id', 'name')->get();
    }

    #[Computed]
    public function statistics(): array
    {
        $summaries = $this->cashTransactionRepository->calculateTransactionSums();
        $paidStatus = $this->studentRepository->getStudentPaymentStatus(
            now()->createFromDate($this->currentWeek['startOfWeek'])->format('Y-m-d'),
            now()->createFromDate($this->currentWeek['endOfWeek'])->format('Y-m-d')
        );

        return [
            'totalCurrentMonth' => local_amount_format($summaries['month']),
            'totalCurrentYear' => local_amount_format($summaries['year']),
            'studentsPaidThisWeekCount' => $paidStatus['studentsPaid']->count(),
            'studentsNotPaidThisWeekCount' => $paidStatus['studentsNotPaid']->count(),
            'studentsNotPaidThisWeekLimit' => $paidStatus['studentsNotPaid']->take(6),
            'studentsNotPaidThisWeek' => $paidStatus['studentsNotPaid'],
        ];
    }

    #[Computed]
    public function cashTransactions(): Paginator
    {
        return CashTransaction::query()
            ->with([
                'student.schoolMajor',
                'student.schoolClass',
                'createdBy',
            ])
            ->whereBetween('date_paid', [
                now()->createFromDate($this->currentWeek['startOfWeek'])->startOfDay(),
                now()->createFromDate($this->currentWeek['endOfWeek'])->endOfDay(),
            ])
            ->when($this->filterByUserID, fn ($q) => $q->where('created_by', $this->filterByUserID))
            ->when($this->filterBySchoolMajorID, fn ($q) => $q->whereRelation('student', 'school_major_id', $this->filterBySchoolMajorID))
            ->when($this->filterBySchoolClassID, fn ($q) => $q->whereRelation('student', 'school_class_id', $this->filterBySchoolClassID))
            ->when($this->search, fn ($q) => $q->search($this->search))
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($this->perPage);
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
        $validator = Validator::make(
            [$property => $this->{$property}],
            $this->getValidationRules($property)
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
            'filterByUserID' => ['filterByUserID' => ['nullable', 'integer', 'exists:users,id']],
            'filterBySchoolMajorID' => ['filterBySchoolMajorID' => ['nullable', 'integer', 'exists:school_majors,id']],
            'filterBySchoolClassID' => ['filterBySchoolClassID' => ['nullable', 'integer', 'exists:school_classes,id']],
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
            'filterByUserID' => '',
            'filterBySchoolMajorID' => '',
            'filterBySchoolClassID' => '',
            default => $this->{$property},
        };
    }

    /**
     * Render the view.
     */
    #[On(['cash-transaction-created', 'cash-transaction-updated', 'cash-transaction-deleted'])]
    public function render(): View
    {
        return view('livewire.cash-transactions.cash-transaction-current-week-table');
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
            'filterByUserID',
            'filterBySchoolMajorID',
            'filterBySchoolClassID',
        ]);

        $this->resetPage();
    }
}
