<?php

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use App\Services\CashTransactionStatisticService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Halaman Kas Minggu Ini')] class extends Component
{
    use WithPagination;

    protected CashTransactionStatisticService $cashTransactionStatisticService;

    public string $startOfWeek;

    public string $endOfWeek;

    public int $studentCount;

    public int $studentPaidThisWeekCount;

    public int $studentNotPaidThisWeekCount;

    public float $totalThisWeek;

    public float $totalThisMonth;

    public float $totalThisYear;

    public float $totalPreviousWeek;

    public float $totalPreviousMonth;

    public float $totalPreviousYear;

    public float $weekOverWeekGrowthRate;

    public float $monthOverMonthGrowthRate;

    public float $yearOverYearGrowthRate;

    public string $weeklyTrend;

    public string $monthlyTrend;

    public string $yearlyTrend;

    /**
     * Boot method runs on every request.
     */
    public function boot(CashTransactionStatisticService $cashTransactionStatisticService): void
    {
        $this->cashTransactionStatisticService = $cashTransactionStatisticService;
    }

    /**
     * Initialize component with data
     */
    public function mount()
    {
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');

        // calculate statistics
        $this->calculateStatistics();
    }

    /**
     * Number of items per page
     * Persisted in URL
     */
    #[Url]
    public int $perPage = 5;

    /**
     * Search query for filtering
     * Persisted in URL
     */
    #[Url]
    public string $search = '';

    /**
     * Current sorting configuration
     * Persisted in URL
     */
    #[Url]
    public string $sortBy = 'newest';

    #[Url]
    public string $school_class_id = '';

    #[Url]
    public string $school_major_id = '';

    #[Url]
    public string $gender = '';

    #[Url]
    public string $created_by = '';

    /**
     * Calculate all dashboard statistics for the current view
     *
     * This method aggregates and calculates various statistics including:
     * - Student counts and payment status for the current week
     * - Total cash collected for current and previous periods (week, month, year)
     */
    public function calculateStatistics(): void
    {
        $this->studentCount = Student::count();

        $this->studentPaidThisWeekCount = Student::whereHas('cashTransactions', function (Builder $q) {
            $q->whereBetween('date_paid', [$this->startOfWeek, $this->endOfWeek]);
        })->count();

        $this->studentNotPaidThisWeekCount = Student::whereDoesntHave('cashTransactions', function (Builder $q) {
            $q->whereBetween('date_paid', [$this->startOfWeek, $this->endOfWeek]);
        })->count();

        $cashTransactionStatisticsSummary = $this->cashTransactionStatisticService->summary();

        // Assign totals
        $this->totalThisWeek = $cashTransactionStatisticsSummary['totals']['current_week'];
        $this->totalThisMonth = $cashTransactionStatisticsSummary['totals']['current_month'];
        $this->totalThisYear = $cashTransactionStatisticsSummary['totals']['current_year'];
        $this->totalPreviousWeek = $cashTransactionStatisticsSummary['totals']['previous_week'];
        $this->totalPreviousMonth = $cashTransactionStatisticsSummary['totals']['previous_month'];
        $this->totalPreviousYear = $cashTransactionStatisticsSummary['totals']['previous_year'];

        // Growth rates
        $this->weekOverWeekGrowthRate = $cashTransactionStatisticsSummary['growth_rates']['week_over_week'];
        $this->monthOverMonthGrowthRate = $cashTransactionStatisticsSummary['growth_rates']['month_over_month'];
        $this->yearOverYearGrowthRate = $cashTransactionStatisticsSummary['growth_rates']['year_over_year'];

        // Determine trends
        $this->weeklyTrend = $cashTransactionStatisticsSummary['trends']['weekly'];
        $this->monthlyTrend = $cashTransactionStatisticsSummary['trends']['monthly'];
        $this->yearlyTrend = $cashTransactionStatisticsSummary['trends']['yearly'];
    }

    /**
     * Retrieve all school majors
     */
    #[Computed]
    public function schoolMajors(): Collection
    {
        return SchoolMajor::withCount('students')->orderBy('name')->get();
    }

    /**
     * Retrieve all school classes
     */
    #[Computed]
    public function schoolClasses(): Collection
    {
        return SchoolClass::withCount('students')->orderBy('name')->get();
    }

    /**
     * Retrieve all users
     */
    #[Computed]
    public function users(): Collection
    {
        return User::orderBy('name')->get();
    }

    /**
     * Calculate percentage of students who have paid this week
     */
    #[Computed]
    public function paidPercentageThisWeek(): float
    {
        $total = $this->studentCount;
        $paid = $this->studentPaidThisWeekCount;

        // Handle division by zero
        if ($total === 0) {
            return 0.0;
        }

        return round(($paid / $total) * 100, 1);
    }

    /**
     * Calculate percentage of students who have not paid this week
     */
    #[Computed]
    public function unpaidPercentageThisWeek(): float
    {
        $total = $this->studentCount;
        $unpaid = $this->studentNotPaidThisWeekCount;

        // Handle division by zero
        if ($total === 0) {
            return 0.0;
        }

        return round(($unpaid / $total) * 100, 1);
    }

    /**
     * Get paginated list with filters and sorting
     */
    #[Computed]
    public function cashTransactions(): LengthAwarePaginator
    {
        return CashTransaction::query()
            ->with([
                'student.schoolMajor',
                'student.schoolClass',
                'createdBy',
            ])
            ->when($this->search, fn (Builder $q) => $q->search((string) $this->search))
            ->when($this->sortBy, fn (Builder $q) => $q->sort((string) $this->sortBy))
            ->when($this->school_major_id, fn (Builder $q) => $q->whereHas('student', fn (Builder $studentQuery) => $studentQuery->filterBySchoolMajor($this->school_major_id)))
            ->when($this->school_class_id, fn (Builder $q) => $q->whereHas('student', fn (Builder $studentQuery) => $studentQuery->filterBySchoolClass($this->school_class_id)))
            ->when($this->gender, fn (Builder $q) => $q->whereHas('student', fn (Builder $studentQuery) => $studentQuery->filterByGender($this->gender)))
            ->when($this->created_by, fn (Builder $q) => $q->where('created_by', $this->created_by))
            ->whereBetween('date_paid', [$this->startOfWeek, $this->endOfWeek])
            ->paginate((int) $this->perPage);
    }

    /**
     * Reset all filters to default values
     */
    public function resetFilters(): void
    {
        $this->reset(['perPage', 'search', 'sortBy', 'school_class_id', 'school_major_id']);
        $this->resetPage();
    }

    /**
     * Handle property updates
     */
    public function updated(string $property): void
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    /**
     * Determine whether any filters are currently applied
     */
    public function hasActiveFilters(): bool
    {
        return $this->search || $this->school_major_id || $this->school_class_id;
    }

    /**
     * Custom refresh method to recalculate statistics
     */
    public function refresh()
    {
        // recalculate statistics
        $this->calculateStatistics();
    }
};
