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
     * Calculate the total sums of cash transactions for all the time.
     *
     * This method calculates the total amounts of cash transactions for the year
     * month, week, and today. It aggregates the amounts accordingly.
     *
     * @param int $year the year of cash transactions
     *
     * @return \Illuminate\Support\Collection
     */
    public function calculateTransactionSums(int $year): SupportCollection
    {
        $sums = collect();
        $now = now();

        $cashTransactions = $this->model->select('date_paid', 'amount')->whereYear('date_paid', $year)->get();

        $yearSum = $cashTransactions->filter(function (CashTransaction $transaction) use ($now): bool {
            return $now->isSameYear($transaction->date_paid);
        })->sum('amount');

        $monthSum = $cashTransactions->filter(function (CashTransaction $transaction) use ($now): bool {
            return $now->isSameMonth($transaction->date_paid);
        })->sum('amount');

        $weekSum = $cashTransactions->filter(function (CashTransaction $transaction) use ($now): bool {
            return $now->parse($transaction->date_paid)
                ->between($now->startOfWeek()->toDateString(), $now->endOfWeek()->toDateString());
        })->sum('amount');

        $todaySum = $cashTransactions->filter(function (CashTransaction $transaction) use ($now): bool {
            return $now->parse($transaction->date_paid)->isToday();
        })->sum('amount');

        $sums->put('year', $yearSum);
        $sums->put('month', $monthSum);
        $sums->put('week', $weekSum);
        $sums->put('today', $todaySum);

        return $sums;
    }

    /**
     * Get the count of cash transactions grouped by gender.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountByGender(): SupportCollection
    {
        return $this->model->leftJoin('students', 'cash_transactions.student_id', '=', 'students.id')
            ->selectRaw('students.gender AS gender, COUNT(*) AS total_paid')
            ->groupBy('gender')
            ->get();
    }

    /**
     * Retrieve cash transaction counts grouped by year.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountsPerYear(): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, COUNT(*) AS count')
            ->groupBy('year')
            ->get();
    }

    /**
     * Retrieve cash transaction counts for a specific year grouped by month.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function getCountsSpecificYear(int $year): SupportCollection
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
    public function getTotalAmountsPerYear(): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(YEAR FROM date_paid) AS year, SUM(amount) AS amount')
            ->groupBy('year')
            ->orderBy('year')
            ->get();
    }

    /**
     * Get the total amount paid each month for a specific year.
     *
     * @param int $year
     * @return \Illuminate\Support\Collection
     */
    public function getTotalAmountsSpecificYear(int $year): SupportCollection
    {
        return $this->model->selectRaw('EXTRACT(MONTH FROM date_paid) AS month, SUM(amount) AS amount')
            ->whereYear('date_paid', $year)
            ->groupBy('month')
            ->get()
            ->pluck('amount', 'month');
    }
}
