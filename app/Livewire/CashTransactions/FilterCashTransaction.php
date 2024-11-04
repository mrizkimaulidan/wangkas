<?php

namespace App\Livewire\CashTransactions;

use App\Models\CashTransaction;
use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
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

    public ?string $start_date = '';

    public ?string $end_date = '';

    public ?string $query = '';

    public ?array $statistics = [];

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
        $this->statistics = [
            'totalCurrentWeek' => 0,
            'totalCurrentMonth' => 0,
            'totalCurrentYear' => 0,
            'studentsNotPaidLimit' => collect(),
            'studentsNotPaid' => collect(),
            'studentsNotPaidCount' => 0,
        ];
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
    public function render(): View
    {
        $sumAmountDateRange = CashTransaction::whereBetween('date_paid', [$this->start_date, $this->end_date])->sum('amount');

        $filteredResult = CashTransaction::query()
            ->with('student', 'createdBy')
            ->when($this->query, function (Builder $query) {
                return $query->whereHas('student', function ($studentQuery) {
                    return $studentQuery->where('name', 'like', "%{$this->query}%");
                });
            })
            ->whereBetween('date_paid', [$this->start_date, $this->end_date]);

        if ($this->start_date && $this->end_date !== null) {
            $studentPaidStatus = $this->studentRepository->getStudentPaymentStatus($this->start_date, $this->end_date);

            $this->statistics['studentsNotPaidLimit'] = $studentPaidStatus['studentsNotPaid']->take(6);
            $this->statistics['studentsNotPaid'] = $studentPaidStatus['studentsNotPaid'];
            $this->statistics['studentsNotPaidCount'] = $studentPaidStatus['studentsNotPaid']->count();
        }

        $cashTransactionSummaries = $this->cashTransactionRepository->calculateTransactionSums();

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
