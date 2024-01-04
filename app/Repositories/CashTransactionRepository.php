<?php

namespace App\Repositories;

use App\Models\CashTransaction;
use Illuminate\Support\Collection as SupportCollection;

class CashTransactionRepository
{
    public function __construct(
        private CashTransaction $model
    ) {
    }

    /**
     * Apply filter to retrieve cash transaction data grouped by year.
     *
     * @return \Illuminate\Support\Collection
     */
    public function applyFilterPerYear(): SupportCollection
    {
        return $this->model->selectRaw('YEAR(date_paid) AS year, COUNT(*) AS count')
            ->groupBy('year')
            ->get()
            ->pluck('count', 'year');
    }

    /**
     * Apply filter to retrieve cash transaction data grouped by month and ordered by month.
     *
     * @return \Illuminate\Support\Collection
     */
    public function applyFilterAllMonths(): SupportCollection
    {
        return $this->model->selectRaw('MONTH(date_paid) AS month, COUNT(*) AS count')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');
    }

    /**
     * Apply filter to retrieve cash transaction data for a specific year grouped by month and ordered by month.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function applyFilterSpecificYear($year): SupportCollection
    {
        return $this->model->selectRaw('MONTH(date_paid) AS month, COUNT(*) AS count')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month');
    }

    /**
     * Retrieve the total sum of amounts paid for each year.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTotalAmountByYear(): SupportCollection
    {
        return $this->model->selectRaw('YEAR(date_paid) AS year, SUM(amount) AS amount')
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->pluck('amount', 'year');
    }
}
