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

    private const DEFAULT_LIMIT = 5;

    private const DEFAULT_SORT_COLUMN = 'date_paid';

    private const DEFAULT_SORT_ORDER = 'desc';

    private const VALID_LIMITS = [5, 10, 15, 20, 25];

    private const VALID_SORT_COLUMNS = ['date_paid', 'amount', 'created_at'];

    private const VALID_SORT_ORDERS = ['asc', 'desc'];

    protected StudentRepository $studentRepository;

    protected CashTransactionRepository $cashTransactionRepository;

    public int $perPage = self::DEFAULT_LIMIT;

    public string $sortBy = self::DEFAULT_SORT_COLUMN;

    public string $sortOrder = self::DEFAULT_SORT_ORDER;

    public ?string $start_date = '';

    public ?string $end_date = '';

    public ?string $search = '';

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
     * Reset all filters to default values
     */
    public function resetFilters(): void
    {
        $this->reset([
            'search',
            'perPage',
            'sortBy',
            'sortOrder',
        ]);

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
            ->when($this->search, function (Builder $query) {
                return $query->whereHas('student', function ($studentQuery) {
                    return $studentQuery->where('name', 'like', "%{$this->search}%");
                });
            })
            ->whereBetween('date_paid', [$this->start_date, $this->end_date])
            ->orderBy($this->sortBy, $this->sortOrder);

        if ($this->start_date && $this->end_date) {
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
            'filteredResult' => $filteredResult->paginate($this->perPage),
            'sumAmountDateRange' => $sumAmountDateRange,
        ]);
    }
}
