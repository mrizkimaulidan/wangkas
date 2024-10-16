<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\Student;
use App\Models\User;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Database\Eloquent\Builder;
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

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'date_paid';

    public string $orderBy = 'desc';

    public array $statistics = [];

    public array $currentWeek = [];

    public array $filters = [
        'user_id' => '',
    ];

    public function boot(
        StudentRepository $studentRepository,
        CashTransactionRepository $cashTransactionRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->cashTransactionRepository = $cashTransactionRepository;
    }

    public function mount()
    {
        $this->currentWeek['startOfWeek'] = now()->startOfWeek()->format('d-m-Y');
        $this->currentWeek['endOfWeek'] = now()->endOfWeek()->format('d-m-Y');
    }

    public function updated()
    {
        return $this->resetPage();
    }

    #[On('cash-transaction-created')]
    #[On('cash-transaction-updated')]
    #[On('cash-transaction-deleted')]
    public function render()
    {
        $users = User::orderBy('name')->get();
        $students = Student::all();

        $cashTransactions = CashTransaction::query()
            ->with('student', 'createdBy')
            ->whereBetween('date_paid', [now()->startOfWeek(), now()->endOfWeek()])
            ->when($this->filters['user_id'], function (Builder $query) {
                return $query->where('created_by', '=', $this->filters['user_id']);
            })
            ->search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        $cashTransactionSummaries = $this->cashTransactionRepository->calculateTransactionSums(now()->year);
        $this->statistics['totalCurrentMonth'] = local_amount_format($cashTransactionSummaries['month']);
        $this->statistics['totalCurrentYear'] = local_amount_format($cashTransactionSummaries['year']);

        $studentPaidStatus = $this->studentRepository->getStudentPaymentStatus($cashTransactions);
        $this->statistics['studentsNotPaidThisWeekLimit'] = $studentPaidStatus['studentsNotPaid']->take(6);
        $this->statistics['studentsNotPaidThisWeek'] = $studentPaidStatus['studentsNotPaid'];
        $this->statistics['studentsPaidThisWeekCount'] = $studentPaidStatus['studentsPaid']->count();
        $this->statistics['studentsNotPaidThisWeekCount'] = $studentPaidStatus['studentsNotPaid']->count();

        return view('livewire.cash-transactions.cash-transaction-current-week-table', [
            'cashTransactions' => $cashTransactions,
            'students' => $students,
            'users' => $users,
        ]);
    }

    public function resetFilter()
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
