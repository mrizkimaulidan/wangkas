<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Halaman Filter Transaksi Kas')]
class FilterCashTransaction extends Component
{
    use WithPagination;

    protected StudentRepository $studentRepository;

    protected CashTransactionRepository $cashTransactionRepository;

    public $start_date;

    public $end_date;

    public $query;

    public array $statistics = [];

    public function boot(
        StudentRepository $studentRepository,
        CashTransactionRepository $cashTransactionRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->cashTransactionRepository = $cashTransactionRepository;
    }

    public function mount()
    {
        $this->statistics = [
            'totalCurrentDay' => 0,
            'totalCurrentWeek' => 0,
            'totalCurrentMonth' => 0,
            'totalCurrentYear' => 0,
            'studentsNotPaidLimit' => collect(),
            'studentsNotPaid' => collect(),
            'studentsNotPaidCount' => 0,
        ];
    }

    public function render()
    {
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

        if ($this->start_date && $this->end_date !== null) {
            $studentPaidStatus = $this->studentRepository->getStudentPaymentStatus($filteredResult);

            $this->statistics['studentsNotPaidLimit'] = $studentPaidStatus['studentsNotPaid']->take(6);
            $this->statistics['studentsNotPaid'] = $studentPaidStatus['studentsNotPaid'];
            $this->statistics['studentsNotPaidCount'] = $studentPaidStatus['studentsNotPaid']->count();
        }

        $cashTransactionSummaries = $this->cashTransactionRepository->calculateTransactionSums(now()->year);

        $this->statistics['totalToday'] = local_amount_format($cashTransactionSummaries['today']);
        $this->statistics['totalCurrentWeek'] = local_amount_format($cashTransactionSummaries['week']);
        $this->statistics['totalCurrentMonth'] = local_amount_format($cashTransactionSummaries['month']);
        $this->statistics['totalCurrentYear'] = local_amount_format($cashTransactionSummaries['year']);

        return view('livewire.cash-transactions.filter-cash-transaction', [
            'filteredResult' => $filteredResult->paginate(5),
            'sumAmountDateRange' => $sumAmountDateRange,
        ]);
    }
}
