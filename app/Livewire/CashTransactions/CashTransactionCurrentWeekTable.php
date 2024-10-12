<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\Student;
use App\Models\User;
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

    public string $query = '';

    public int $limit = 5;

    public string $orderByColumn = 'date_paid';

    public string $orderBy = 'desc';

    public array $statistics = [
        'totalCurrentMonth' => 0,
        'totalCurrentYear' => 0,
        'studentsPaidThisWeekCount' => 0,
        'studentsNotPaidThisWeekCount' => 0,
    ];

    public array $currentWeek = [
        'startOfWeek' => null,
        'endOfWeek' => null,
    ];

    public array $filters = [
        'user_id' => '',
    ];

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
        $students = Student::with(['cashTransactions' => function ($query) {
            return $query->whereBetween('date_paid', [now()->startOfWeek(), now()->endOfWeek()]);
        }, 'schoolClass', 'schoolMajor'])->get();

        $users = User::orderBy('name')->get();

        $cashTransactions = CashTransaction::query()
            ->with('student', 'createdBy')
            ->whereBetween('date_paid', [now()->startOfWeek(), now()->endOfWeek()])
            ->when($this->filters['user_id'], function (Builder $query) {
                return $query->where('created_by', '=', $this->filters['user_id']);
            })
            ->search($this->query)
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        $this->calculateStatistics($students);

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

    public function calculateStatistics(Collection $students)
    {
        $currentYear = now()->year;
        $cashTransactions = CashTransaction::whereYear('date_paid', $currentYear)->get();

        $totalAmountCurrentMonth = $cashTransactions->filter(function ($cashTransaction) {
            return now()->isSameMonth($cashTransaction->date_paid);
        })->sum('amount');

        $studentsPaidThisWeek = $students->filter(function ($student) {
            return $student->cashTransactions->isNotEmpty();
        });

        $studentsNotPaidThisWeek = $students->filter(function ($student) {
            return $student->cashTransactions->isEmpty();
        })->sortBy('name');

        $this->statistics = [
            'totalCurrentMonth' => local_amount_format($totalAmountCurrentMonth),
            'totalCurrentYear' => local_amount_format($cashTransactions->sum('amount')),
            'studentsNotPaidThisWeekLimit' => $studentsNotPaidThisWeek->take(6),
            'studentsPaidThisWeekCount' => $studentsPaidThisWeek->count(),
            'studentsNotPaidThisWeekCount' => $studentsNotPaidThisWeek->count(),
            'studentsNotPaidThisWeek' => $studentsNotPaidThisWeek,
        ];
    }
}
