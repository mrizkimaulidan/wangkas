<?php

namespace App\Http\Controllers;

use App\Repositories\CashTransactionReportRepository;
use Illuminate\View\View;

class CashTransactionReportController extends Controller
{
    public function __construct(
        private  CashTransactionReportRepository $cashTransactionReportRepository
    ) {
    }

    public function __invoke(): View
    {
        $filtered_results = $this->cashTransactionReportRepository->filter();

        $sums = [
            'this_day' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'this_day')),
            'this_week' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'this_week')),
            'this_month' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'this_month')),
            'this_year' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'this_year')),
        ];

        return view('reports.index', [
            'sums' => $sums,
            'reports_data' => $filtered_results['filtered_data'] ?? null,
            'total_amount_is_paid' => $filtered_results['total_amount']['is_paid'] ?? null,
            'total_amount_is_not_paid' => $filtered_results['total_amount']['is_not_paid'] ?? null,
        ]);
    }
}
