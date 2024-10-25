<?php

namespace App\Repositories;

use App\Models\CashTransaction;
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
    public function calculateTransactionSums(int $year): SupportCollection
    {
        $now = now();
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();

        $cashTransactions = $this->model
            ->select('date_paid', 'amount')
            ->whereYear('date_paid', $year)
            ->get();

        $yearSum = $this->calculateSumForPeriod($cashTransactions, fn ($transaction) => $now
            ->isSameYear($transaction->date_paid));

        $monthSum = $this->calculateSumForPeriod($cashTransactions, fn ($transaction) => $now
            ->isSameMonth($transaction->date_paid));

        $weekSum = $this->calculateSumForPeriod($cashTransactions, fn ($transaction) => $now->parse($transaction->date_paid)
            ->between($startOfWeek, $endOfWeek));

        $todaySum = $this->calculateSumForPeriod($cashTransactions, fn ($transaction) => $now->parse($transaction->date_paid)
            ->isToday());

        return collect([
            'year' => $yearSum,
            'month' => $monthSum,
            'week' => $weekSum,
            'today' => $todaySum,
        ]);
    }

    /**
     * Helper method to calculate the sum for a specific period.
     */
    private function calculateSumForPeriod(SupportCollection $cashTransactions, \Closure $filterCondition): int
    {
        return $cashTransactions->filter($filterCondition)->sum('amount');
    }
}
