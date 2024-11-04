<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\Student;
use App\Models\User;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

    public Collection $students;

    public Collection $users;

    public ?string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'date_paid';

    public string $orderBy = 'desc';

    public ?array $statistics = [];

    public ?array $currentWeek = [];

    public array $filters = [
        'user_id' => '',
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

        $this->users = User::orderBy('name')->get();
        $this->students = Student::all();
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
        $cashTransactions = CashTransaction::query()
            ->with('student', 'createdBy')
            ->whereBetween('date_paid', [now()->startOfWeek()->toDateString(), now()->endOfWeek()->toDateString()])
            ->when($this->filters['user_id'], function (Builder $query) {
                return $query->where('created_by', '=', $this->filters['user_id']);
            })
            ->search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        $cashTransactionSummaries = $this->cashTransactionRepository->calculateTransactionSums();
        $this->statistics['totalCurrentMonth'] = local_amount_format($cashTransactionSummaries['month']);
        $this->statistics['totalCurrentYear'] = local_amount_format($cashTransactionSummaries['year']);

        $studentPaidStatus = $this->studentRepository->getStudentPaymentStatus(
            startDate: now()->createFromDate($this->currentWeek['startOfWeek'])->format('Y-m-d'),
            endDate: now()->createFromDate($this->currentWeek['endOfWeek'])->format('Y-m-d')
        );
        $this->statistics['studentsNotPaidThisWeekLimit'] = $studentPaidStatus['studentsNotPaid']->take(6);
        $this->statistics['studentsNotPaidThisWeek'] = $studentPaidStatus['studentsNotPaid'];
        $this->statistics['studentsPaidThisWeekCount'] = $studentPaidStatus['studentsPaid']->count();
        $this->statistics['studentsNotPaidThisWeekCount'] = $studentPaidStatus['studentsNotPaid']->count();

        return view('livewire.cash-transactions.cash-transaction-current-week-table', [
            'cashTransactions' => $cashTransactions,
        ]);
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
