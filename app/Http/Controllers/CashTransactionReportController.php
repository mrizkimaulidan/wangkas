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
        $results = $this->cashTransactionReportRepository->filter();

        $sum = [
            'thisDay' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisDay')),
            'thisWeek' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisWeek')),
            'thisMonth' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisMonth')),
            'thisYear' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisYear')),
        ];

        return view('reports.index', [
            'sum' => $sum,
            'reports' => $results['filteredData'],
            'amount' => [
                'isPaid' => $results['totalAmount']['isPaid'],
                'isNotPaid' => $results['totalAmount']['isNotPaid']
            ]
        ]);
    }
}
