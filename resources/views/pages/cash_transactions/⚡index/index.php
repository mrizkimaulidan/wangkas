<?php

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Number;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Halaman Kas Minggu Ini')] class extends Component
{
    use WithPagination;

    public string $startOfWeek;

    public string $endOfWeek;

    /**
     * Initialize component with data
     */
    public function mount()
    {
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
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

    // ==============================================
    // STUDENT STATISTICS
    // ==============================================

    /**
     * Get the total count of students
     */
    #[Computed]
    public function studentCount(): int
    {
        return Student::count();
    }

    /**
     * Count students who have made at least one payment during the current week
     */
    #[Computed]
    public function studentPaidThisWeekCount(): int
    {
        return Student::whereHas('cashTransactions', function (Builder $q) {
            $q->whereBetween('date_paid', [$this->startOfWeek, $this->endOfWeek]);
        })->count();
    }

    /**
     * Count students who have NOT made any payments during the current week
     */
    #[Computed]
    public function studentNotPaidThisWeekCount(): int
    {
        return Student::whereDoesntHave('cashTransactions', function (Builder $q) {
            $q->whereBetween('date_paid', [$this->startOfWeek, $this->endOfWeek]);
        })->count();
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

    // ==============================================
    // CURRENT PERIOD TOTALS
    // ==============================================

    /**
     * Calculate total cash amount collected during the current week
     */
    #[Computed]
    public function totalThisWeek(): float
    {
        return CashTransaction::whereBetween('date_paid', [$this->startOfWeek, $this->endOfWeek])->sum('amount') ?? 0;
    }

    /**
     * Calculate total cash amount collected during the current month
     */
    #[Computed]
    public function totalThisMonth(): float
    {
        return CashTransaction::whereYear('date_paid', now()->year)
            ->whereMonth('date_paid', now()->month)
            ->sum('amount') ?? 0;
    }

    /**
     * Calculate total cash amount collected during the current year
     */
    #[Computed]
    public function totalThisYear(): float
    {
        return CashTransaction::whereYear('date_paid', now()->year)
            ->sum('amount') ?? 0;
    }

    // ==============================================
    // PREVIOUS PERIOD TOTALS
    // ==============================================

    /**
     * Calculate total cash amount collected during the previous week
     */
    #[Computed]
    public function totalPreviousWeek(): float
    {
        $previousWeekStart = now()->subWeek()->startOfWeek()->format('Y-m-d');
        $previousWeekEnd = now()->subWeek()->endOfWeek()->format('Y-m-d');

        return CashTransaction::whereBetween('date_paid', [$previousWeekStart, $previousWeekEnd])->sum('amount') ?? 0;
    }

    /**
     * Calculate total cash amount collected during the previous month
     */
    #[Computed]
    public function totalPreviousMonth(): float
    {
        $previousMonth = now()->subMonth();

        return CashTransaction::whereYear('date_paid', $previousMonth->year)
            ->whereMonth('date_paid', $previousMonth->month)
            ->sum('amount') ?? 0;
    }

    /**
     * Calculate total cash collected during the previous calendar year
     */
    #[Computed]
    public function totalPreviousYear(): float
    {
        return CashTransaction::whereYear('date_paid', now()->subYear()->year)
            ->sum('amount') ?? 0;
    }

    // ==============================================
    // GROWTH RATE CALCULATIONS
    // ==============================================

    /**
     * Calculate week-over-week percentage change in cash collection
     */
    #[Computed]
    public function weekOverWeekGrowthRate(): float
    {
        $currentWeek = $this->totalThisWeek;
        $previousWeek = $this->totalPreviousWeek;

        // Handle division by zero
        if ($previousWeek == 0) {
            return $currentWeek > 0 ? 100.0 : 0.0;
        }

        $percentage = (($currentWeek - $previousWeek) / $previousWeek) * 100;

        return round($percentage, 1);
    }

    /**
     * Calculate month-over-month percentage change in cash collection
     */
    #[Computed]
    public function monthOverMonthGrowthRate(): float
    {
        $current = $this->totalThisMonth;
        $previous = $this->totalPreviousMonth;

        // Handle division by zero
        if ($previous == 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        $percentage = (($current - $previous) / $previous) * 100;

        return round($percentage, 1);
    }

    /**
     * Calculate year-over-year percentage change in cash collection
     */
    #[Computed]
    public function yearOverYearGrowthRate(): float
    {
        $current = $this->totalThisYear;
        $previous = $this->totalPreviousYear;

        // Handle division by zero
        if ($previous == 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        $percentage = (($current - $previous) / $previous) * 100;

        return round($percentage, 1);
    }

    // ==============================================
    // TREND DIRECTION DETERMINATIONS
    // ==============================================

    /**
     * Determine trend direction based on week-over-week growth
     */
    #[Computed]
    public function weeklyGrowthTrendDirection(): string
    {
        return $this->weekOverWeekGrowthRate >= 0 ? 'up' : 'down';
    }

    /**
     * Determine trend direction based on month-over-month growth
     */
    #[Computed]
    public function monthlyGrowthTrendDirection(): string
    {
        return $this->monthOverMonthGrowthRate >= 0 ? 'up' : 'down';
    }

    /**
     * Determine trend direction based on year-over-year growth
     */
    #[Computed]
    public function yearlyGrowthTrendDirection(): string
    {
        return $this->yearOverYearGrowthRate >= 0 ? 'up' : 'down';
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
            ->when($this->search, fn ($q) => $q->search((string) $this->search))
            ->when($this->sortBy, fn ($q) => $q->sort((string) $this->sortBy))
            ->when($this->school_major_id, fn ($q) => $q->whereHas('student', fn (Builder $studentQuery) => $studentQuery->filterBySchoolMajor($this->school_major_id)))
            ->when($this->school_class_id, fn ($q) => $q->whereHas('student', fn (Builder $studentQuery) => $studentQuery->filterBySchoolClass($this->school_class_id)))
            ->when($this->gender, fn ($q) => $q->whereHas('student', fn (Builder $studentQuery) => $studentQuery->filterByGender($this->gender)))
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
};
