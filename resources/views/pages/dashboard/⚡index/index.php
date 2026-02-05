<?php

use App\Models\CashTransaction;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Beranda')] class extends Component
{
    private $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

    public string $year;

    public array $monthlyTransactionSummary;

    /**
     * Initialize component with data
     */
    public function mount(): void
    {
        $this->year = now()->year;

        $monthlyAmounts = $this->getMonthlyAmounts($this->year)->pluck('amount', 'month');
        $monthlyCounts = $this->getMonthlyCounts($this->year)->pluck('count', 'month');

        $this->monthlyTransactionSummary = [
            'amount' => $this->fillMissingMonthsCounts($monthlyAmounts),
            'count' => $this->fillMissingMonthsCounts($monthlyCounts),
        ];
    }

    /**
     * Get total count of student record
     */
    #[Computed]
    public function studentCount(): int
    {
        return Student::count();
    }

    /**
     * Get total count of school class record
     */
    #[Computed]
    public function schoolClassCount(): int
    {
        return SchoolClass::count();
    }

    /**
     * Get total count of school major record
     */
    #[Computed]
    public function schoolMajorCount(): int
    {
        return SchoolMajor::count();
    }

    /**
     * Get total count of user record
     */
    #[Computed]
    public function userCount(): int
    {
        return User::count();
    }

    /**
     * Get total monthly transaction amounts for a given year.
     *
     * @param  int  $year  The year to retrieve data for.
     * @return Collection Collection with 'month' and 'amount' fields.
     */
    public function getMonthlyAmounts(int $year): Collection
    {
        return CashTransaction::selectRaw('EXTRACT(MONTH FROM date_paid) AS month, SUM(amount) AS amount')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get();
    }

    /**
     * Get monthly transaction counts for a given year.
     *
     * @param  int  $year  The year to retrieve data for.
     * @return Collection Collection with 'month' and 'count' fields.
     */
    public function getMonthlyCounts(int $year): Collection
    {
        return CashTransaction::selectRaw('EXTRACT(MONTH FROM date_paid) AS month, COUNT(*) AS count')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get();
    }

    /**
     * Fill in missing counts for each month in the provided collection.
     */
    private function fillMissingMonthsCounts(Collection $collection): array
    {
        $statistics = [];

        for ($i = 1; $i <= 12; $i++) {
            // if key exists so there is a borrowing count on that month
            // if key does not exists there is no borrowing on that month so the count
            // should be 0
            $statistics[$this->months[$i - 1]] = isset($collection[$i]) ? $collection[$i] : 0;
        }

        return $statistics;
    }

    /**
     * Dispatch a Livewire event to update both bar and line charts
     * with fresh transaction data for the selected year.
     */
    public function updateChart(): void
    {
        $this->dispatch('chart-updated',
            amount: $this->fillMissingMonthsCounts($this->getMonthlyAmounts($this->year)->pluck('amount', 'month')),
            count: $this->fillMissingMonthsCounts($this->getMonthlyCounts($this->year)->pluck('count', 'month'))
        );
    }
};
