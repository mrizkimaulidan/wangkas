<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
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
        'studentsPaidThisWeek' => 0,
        'studentsNotPaidThisWeek' => 0,
    ];

    #[On('cash-transaction-created')]
    #[On('cash-transaction-updated')]
    #[On('cash-transaction-deleted')]
    public function render()
    {
        $students = Student::all();

        $cashTransactions = CashTransaction::query()
            ->with('student', 'createdBy')
            ->whereBetween('date_paid', [now()->startOfWeek(), now()->endOfWeek()])
            ->when($this->query, function (Builder $query) {
                $this->resetPage();

                return $query->where('id', 'like', "%{$this->query}%");
            })
            ->orderBy($this->orderByColumn, $this->orderBy)
            ->paginate($this->limit);

        $this->calculateStatistics();

        return view('livewire.cash-transactions.cash-transaction-current-week-table', [
            'cashTransactions' => $cashTransactions,
            'students' => $students,
        ]);
    }

    public function resetFilter()
    {
        $this->reset([
            'query',
            'limit',
            'orderByColumn',
            'orderBy',
        ]);
    }

    public function calculateStatistics()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $totalAmountCurrentYear = CashTransaction::whereYear('date_paid', $currentYear)
            ->sum('amount');

        $totalAmountCurrentMonth = CashTransaction::whereYear('date_paid', $currentYear)
            ->whereMonth('date_paid', $currentMonth)
            ->sum('amount');

        $studentsPaidThisWeekCount = Student::whereHas('cashTransactions', function (Builder $query) {
            return $query->whereBetween('date_paid', [now()->startOfWeek(), now()->endOfWeek()]);
        })->count();

        $studentsNotPaidThisWeekCount = Student::whereDoesntHave('cashTransactions', function (Builder $query) {
            return $query->whereBetween('date_paid', [now()->startOfWeek(), now()->endOfWeek()]);
        })->count();

        $this->statistics = [
            'totalCurrentMonth' => $totalAmountCurrentMonth,
            'totalCurrentYear' => $totalAmountCurrentYear,
            'studentsPaidThisWeek' => $studentsPaidThisWeekCount,
            'studentsNotPaidThisWeek' => $studentsNotPaidThisWeekCount,
        ];
    }
}
