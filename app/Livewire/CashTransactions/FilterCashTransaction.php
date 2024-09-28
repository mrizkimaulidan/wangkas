<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Filter Transaksi Kas')]
class FilterCashTransaction extends Component
{
    use WithPagination;

    public $student_id;

    public $user_id;

    public $school_major_id;

    public $school_class_id;

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
            'students' => Student::orderBy('name')->get(),
            'users' => User::orderBy('name')->get(),
            'schoolMajors' => SchoolMajor::orderBy('name')->get(),
            'schoolClasses' => SchoolClass::orderBy('name')->get(),
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
            'totalCurrentDay' => $totalAmountCurrentDay,
            'totalCurrentWeek' => $totalAmountCurrentWeek,
            'totalCurrentMonth' => $totalAmountCurrentMonth,
            'totalCurrentYear' => $cashTransactions->sum('amount'),
        ];
    }
}
