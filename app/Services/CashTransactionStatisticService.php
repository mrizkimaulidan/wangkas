<?php

namespace App\Services;

use App\Models\CashTransaction;

class CashTransactionStatisticService
{
    public function __construct(
        private CashTransaction $model
    ) {}

    /**
     * Calculate total transaction amount for a specific date range.
     *
     * @param  string  $startDate  Start date in Y-m-d format
     * @param  string  $endDate  End date in Y-m-d format
     * @return float Total amount for the date range
     */
    private function totalForDateRange(string $startDate, string $endDate): float
    {
        return $this->model->whereBetween('date_paid', [$startDate, $endDate])->sum('amount');
    }

    /**
     * Calculate total transaction amount for a specific month.
     *
     * @param  int  $year  The year (e.g., 2024)
     * @param  int  $month  The month (1-12)
     * @return float Total amount for the specified month
     */
    private function totalForMonth(int $year, int $month): float
    {
        return $this->model
            ->whereYear('date_paid', $year)
            ->whereMonth('date_paid', $month)
            ->sum('amount');
    }

    /**
     * Calculate total transaction amount for a specific year.
     *
     * @param  int  $year  The year (e.g., 2024)
     * @return float Total amount for the specified year
     */
    private function totalForYear(int $year): float
    {
        return $this->model->whereYear('date_paid', $year)->sum('amount');
    }

    /**
     * Get the start and end dates of the current week.
     * Week starts on Monday and ends on Sunday.
     *
     * @return array<string, string> Associative array with 'start' and 'end' keys
     */
    private function getCurrentWeekRange(): array
    {
        return [
            'start' => now()->startOfWeek()->format('Y-m-d'),
            'end' => now()->endOfWeek()->format('Y-m-d'),
        ];
    }

    /**
     * Get the start and end dates of the previous week.
     * Week starts on Monday and ends on Sunday.
     *
     * @return array<string, string> Associative array with 'start' and 'end' keys
     */
    private function getPreviousWeekRange(): array
    {
        return [
            'start' => now()->subWeek()->startOfWeek()->format('Y-m-d'),
            'end' => now()->subWeek()->endOfWeek()->format('Y-m-d'),
        ];
    }

    /**
     * Calculate percentage change between two periods.
     *
     * @param  float  $previous  Previous period total
     * @param  float  $current  Current period total
     * @param  int  $precision  Number of decimal places (default: 1)
     * @return float Percentage change (can be negative)
     */
    private function calculatePercentageChange(float $previous, float $current, int $precision = 1): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        $percentage = (($current - $previous) / $previous) * 100;

        return round($percentage, $precision);
    }

    /**
     * Determine trend direction based on growth rate.
     *
     * @param  float  $growthRate  The calculated growth rate
     * @return string 'up' if growth rate >= 0, otherwise 'down'
     */
    private function determineTrendDirection(float $growthRate): string
    {
        return $growthRate >= 0 ? 'up' : 'down';
    }

    /**
     * Calculate total transaction amount for the current week.
     *
     * @return float Total amount for the current week
     */
    public function currentWeekTotal(): float
    {
        $weekRange = $this->getCurrentWeekRange();

        return $this->totalForDateRange($weekRange['start'], $weekRange['end']);
    }

    /**
     * Calculate total transaction amount for the previous week.
     *
     * @return float Total amount for the previous week
     */
    public function previousWeekTotal(): float
    {
        $weekRange = $this->getPreviousWeekRange();

        return $this->totalForDateRange($weekRange['start'], $weekRange['end']);
    }

    /**
     * Calculate total transaction amount for the current month.
     *
     * @return float Total amount for the current month
     */
    public function currentMonthTotal(): float
    {
        return $this->totalForMonth(now()->year, now()->month);
    }

    /**
     * Calculate total transaction amount for the previous month.
     *
     * @return float Total amount for the previous month
     */
    public function previousMonthTotal(): float
    {
        $previousMonth = now()->subMonth();

        return $this->totalForMonth($previousMonth->year, $previousMonth->month);
    }

    /**
     * Calculate total transaction amount for the current year.
     *
     * @return float Total amount for the current year
     */
    public function currentYearTotal(): float
    {
        return $this->totalForYear(now()->year);
    }

    /**
     * Calculate total transaction amount for the previous year.
     *
     * @return float Total amount for the previous year
     */
    public function previousYearTotal(): float
    {
        return $this->totalForYear(now()->subYear()->year);
    }

    /**
     * Calculate week-over-week percentage change in cash collection.
     *
     * @param  int  $precision  Number of decimal places (default: 1)
     * @return float Week-over-week growth rate percentage
     */
    public function weekOverWeekGrowthRate(int $precision = 1): float
    {
        return $this->calculatePercentageChange(
            $this->previousWeekTotal(),
            $this->currentWeekTotal(),
            $precision
        );
    }

    /**
     * Calculate month-over-month percentage change in cash collection.
     *
     * @param  int  $precision  Number of decimal places (default: 1)
     * @return float Month-over-month growth rate percentage
     */
    public function monthOverMonthGrowthRate(int $precision = 1): float
    {
        return $this->calculatePercentageChange(
            $this->previousMonthTotal(),
            $this->currentMonthTotal(),
            $precision
        );
    }

    /**
     * Calculate year-over-year percentage change in cash collection.
     *
     * @param  int  $precision  Number of decimal places (default: 1)
     * @return float Year-over-year growth rate percentage
     */
    public function yearOverYearGrowthRate(int $precision = 1): float
    {
        return $this->calculatePercentageChange(
            $this->previousYearTotal(),
            $this->currentYearTotal(),
            $precision
        );
    }

    /**
     * Get weekly trend direction based on week-over-week growth.
     *
     * @return string 'up' if growth is positive/zero, otherwise 'down'
     */
    public function weeklyGrowthTrendDirection(): string
    {
        return $this->determineTrendDirection($this->weekOverWeekGrowthRate());
    }

    /**
     * Get monthly trend direction based on month-over-month growth.
     *
     * @return string 'up' if growth is positive/zero, otherwise 'down'
     */
    public function monthlyGrowthTrendDirection(): string
    {
        return $this->determineTrendDirection($this->monthOverMonthGrowthRate());
    }

    /**
     * Get yearly trend direction based on year-over-year growth.
     *
     * @return string 'up' if growth is positive/zero, otherwise 'down'
     */
    public function yearlyGrowthTrendDirection(): string
    {
        return $this->determineTrendDirection($this->yearOverYearGrowthRate());
    }

    /**
     * Get complete financial summary including all period totals, growth rates, and trends.
     * This is the most efficient method as it executes only 6 database queries total
     * and reuses the results for all calculations.
     *
     * @param  int  $precision  Number of decimal places for percentage calculations (default: 1)
     * @return array<string, mixed> Comprehensive statistics array with the following structure:
     *                              - totals: array<string, float> Period totals
     *                              - growth_rates: array<string, float> Period-over-period growth percentages
     *                              - trends: array<string, string> Trend directions ('up' or 'down')
     */
    public function summary(int $precision = 1): array
    {
        // Get all totals first (6 queries)
        $totals = [
            'current_week' => $this->currentWeekTotal(),
            'current_month' => $this->currentMonthTotal(),
            'current_year' => $this->currentYearTotal(),
            'previous_week' => $this->previousWeekTotal(),
            'previous_month' => $this->previousMonthTotal(),
            'previous_year' => $this->previousYearTotal(),
        ];

        // Calculate growth rates using totals (no additional queries)
        $growthRates = [
            'week_over_week' => $this->calculatePercentageChange(
                $totals['previous_week'], $totals['current_week'], $precision
            ),
            'month_over_month' => $this->calculatePercentageChange(
                $totals['previous_month'], $totals['current_month'], $precision
            ),
            'year_over_year' => $this->calculatePercentageChange(
                $totals['previous_year'], $totals['current_year'], $precision
            ),
        ];

        return [
            'totals' => $totals,
            'growth_rates' => $growthRates,
            'trends' => [
                'weekly' => $this->determineTrendDirection($growthRates['week_over_week']),
                'monthly' => $this->determineTrendDirection($growthRates['month_over_month']),
                'yearly' => $this->determineTrendDirection($growthRates['year_over_year']),
            ],
        ];
    }
}
