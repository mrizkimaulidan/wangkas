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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Daftar Kas Minggu Ini')]
class CashTransactionCurrentWeekTable extends Component
{
    use WithPagination;

    protected StudentRepository $studentRepository;

    protected CashTransactionRepository $cashTransactionRepository;

    public ?string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'date_paid';

    public string $orderBy = 'desc';

    public ?array $currentWeek = [];

    public array $filters = [
        'user_id' => '',
        'schoolMajorID' => '',
        'schoolClassID' => '',
    ];

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
            ->when($this->filters['user_id'], fn (Builder $q) => $q->where('created_by', $this->filters['user_id']))
            ->when($this->filters['schoolMajorID'], fn (Builder $q) => $q->whereRelation('student', 'school_major_id', $this->filters['schoolMajorID']))
            ->when($this->filters['schoolClassID'], fn (Builder $q) => $q->whereRelation('student', 'school_class_id', $this->filters['schoolClassID']))
            ->search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);
    }

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
    #[On('cash-transaction-created')]
    #[On('cash-transaction-updated')]
    #[On('cash-transaction-deleted')]
    public function render(): View
    {
        return view('livewire.cash-transactions.cash-transaction-current-week-table');
    }

    /**
     * Reset the filter criteria to default values.
     */
    public function resetFilter(): void
    {
        $this->reset([
            'query',
            'limit',
            'orderByColumn',
            'orderBy',
            'filters',
        ]);
    }
}
