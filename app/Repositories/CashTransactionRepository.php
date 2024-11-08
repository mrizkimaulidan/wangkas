<?php

namespace App\Repositories;

use App\Models\CashTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class CashTransactionRepository
{
    public function __construct(
        private CashTransaction $model
    ) {}

    /**
     * Calculate the total sums of cash transactions for the given year.
     *
     * This method aggregates the amounts of cash transactions for the year,
     * month, week, and today.
     *
     * @param  int  $year  The year for which to calculate the sums.
     */
    public function calculateTransactionSums(): SupportCollection
    {
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();

        $yearSum = $this->model->select('date_paid', 'amount')->whereYear('date_paid', now()->year)->sum('amount');

        $monthSum = $this->model->select('date_paid', 'amount')->whereMonth('date_paid', now()->month)->sum('amount');

        $weekSum = $this->model->select('date_paid', 'amount')->whereBetween('date_paid', [$startOfWeek, $endOfWeek])
            ->sum('amount');

        $todaySum = $this->model->select('date_paid', 'amount')->whereDate('date_paid', now()->today())
            ->sum('amount');

        return collect([
            'year' => $yearSum,
            'month' => $monthSum,
            'week' => $weekSum,
            'today' => $todaySum,
        ]);
    }

    /**
     * Get total monthly transaction amounts for a given year.
     *
     * @param  int  $year  The year to retrieve data for.
     * @return Collection Collection with 'month' and 'amount' fields.
     */
    public function getMonthlyAmounts(int $year): Collection
    {
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, SUM(amount) AS amount')
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
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, COUNT(*) AS count')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get();
    }
}
