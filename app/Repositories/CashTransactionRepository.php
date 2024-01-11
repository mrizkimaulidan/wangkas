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
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, COUNT(*) AS count')
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
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, COUNT(*) AS count')
            ->groupBy('year')
            ->get()
            ->pluck('count', 'year');
    }

    /**
     * Apply filter to retrieve cash transaction data for a specific year grouped by month and ordered by month.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function applyFilterSpecificYear($year): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, COUNT(*) AS count')
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
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, SUM(amount) AS amount')
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->pluck('amount', 'year');
    }

    /**
     * Get the total amount paid each month for a specific year.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function getTotalAmountSpecificYear(int $year): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, SUM(amount) AS amount')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get()
            ->pluck('amount', 'month');
    }
}
