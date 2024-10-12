<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Filter Transaksi Kas')]
class FilterCashTransaction extends Component
{
    use WithPagination;

    public $start_date;

    public $end_date;

    public $query;

    public array $statistics = [
        'totalCurrentDay' => 0,
        'totalCurrentWeek' => 0,
        'totalCurrentMonth' => 0,
        'totalCurrentYear' => 0,
    ];

    public $studentsWhoNotPaid;

    public $studentsWhoNotPaidLimit;

    public $studentsWhoNotPaidCount = 0;

    public function render()
    {
        if ($this->start_date && $this->end_date !== null) {
            $students = Student::with(['cashTransactions' => function ($query) {
                return $query->whereBetween('date_paid', [$this->start_date, $this->end_date]);
            }, 'schoolClass', 'schoolMajor'])->get();

            $this->studentsWhoNotPaid = $students->filter(function ($student) {
                return $student->cashTransactions->isEmpty();
            });

            $this->studentsWhoNotPaidCount = $this->studentsWhoNotPaid->count();
            $this->studentsWhoNotPaidLimit = $this->studentsWhoNotPaid->take(6);
        }

        $sumAmountDateRange = CashTransaction::whereBetween('date_paid', [$this->start_date, $this->end_date])->sum('amount');

        $filteredResult = CashTransaction::query()
            ->with('student', 'createdBy')
            ->when($this->query, function (Builder $query) {
                $this->resetPage();

                return $query->whereHas('student', function ($studentQuery) {
                    return $studentQuery->where('name', 'like', "%{$this->query}%");
                });
            })
            ->whereBetween('date_paid', [$this->start_date, $this->end_date]);

        $this->calculateStatistics();

        return view('livewire.cash-transactions.filter-cash-transaction', [
            'filteredResult' => $filteredResult->paginate(5),
            'sumAmountDateRange' => $sumAmountDateRange,
            'studentsWhoNotPaidCount' => $this->studentsWhoNotPaidCount,
            'studentsWhoNotPaid' => $this->studentsWhoNotPaid,
            'studentsWhoNotPaidLimit' => $this->studentsWhoNotPaidLimit,
        ]);
    }

    public function calculateStatistics()
    {
        $currentYear = now()->year;
        $cashTransactions = CashTransaction::whereYear('date_paid', $currentYear)->get();

        $totalAmountCurrentDay = $cashTransactions->filter(function ($cashTransaction) {
            return now()->isSameDay($cashTransaction->date_paid);
        })->sum('amount');

        $totalAmountCurrentWeek = $cashTransactions->filter(function ($cashTransaction) {
            return now()->isSameWeek($cashTransaction->date_paid);
        })->sum('amount');

        $totalAmountCurrentMonth = $cashTransactions->filter(function ($cashTransaction) {
            return now()->isSameMonth($cashTransaction->date_paid);
        })->sum('amount');

        $this->statistics = [
            'totalCurrentDay' => local_amount_format($totalAmountCurrentDay),
            'totalCurrentWeek' => local_amount_format($totalAmountCurrentWeek),
            'totalCurrentMonth' => local_amount_format($totalAmountCurrentMonth),
            'totalCurrentYear' => local_amount_format($cashTransactions->sum('amount')),
        ];
    }
}
