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
