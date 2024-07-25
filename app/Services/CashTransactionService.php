<?php

namespace App\Services;

use Carbon\Carbon;
use App\Exports\CashTransactionsExport;
use App\Models\CashTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class CashTransactionService
{
    /**
     * Calculate the total sums of cash transactions for different time periods.
     *
     * This method calculates the total amounts of cash transactions for the current
     * month, week, and today. It filters the transactions based on their date and
     * aggregates the amounts accordingly.
     *
     * @param \Illuminate\Support\Collection $cashTransactions
     * A collection of cash transactions to be processed. Each transaction should
     * include a `date_paid` and `amount` attribute.
     *
     * @return \Illuminate\Support\Collection
     */
    public function calculateTransactionSums(Collection $cashTransactions): SupportCollection
    {
        $sums = collect();
        $now = now();

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

        $sums->put('month', $monthSum);
        $sums->put('week', $weekSum);
        $sums->put('today', $todaySum);

        return $sums;
    }

    /**
     * Export cash transactions to an Excel file with a date range filter.
     *
     * @param Carbon $startDate Start date for filtering.
     * @param Carbon $endDate End date for filtering.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Carbon $startDate, Carbon $endDate)
    {
        $formattedDateForFileName = $startDate->format('d-m-Y') . '-' . $endDate->format('d-m-Y');
        $fileName = "kas($formattedDateForFileName).xlsx";

        $export = new CashTransactionsExport(
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d')
        );

        return $export->download($fileName);
    }
}
