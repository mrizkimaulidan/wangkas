<?php

namespace App\Http\Controllers;

use App\Repositories\CashTransactionReportRepository;
use Illuminate\Http\Request;

class CashTransactionReportController extends Controller
{
    public function __construct(
        private  CashTransactionReportRepository $cashTransactionReportRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtered_results = $this->cashTransactionReportRepository->filter();

        return view('reports.index', [
            'sum_this_day' => $this->cashTransactionReportRepository->sumAmount('amount', 'this_day'),
            'sum_this_week' => $this->cashTransactionReportRepository->sumAmount('amount', 'this_week'),
            'sum_this_month' => $this->cashTransactionReportRepository->sumAmount('amount', 'this_month'),
            'sum_this_year' => $this->cashTransactionReportRepository->sumAmount('amount', 'this_year'),
            'reports_data' => $filtered_results['filtered_data'] ?? [],
            'total_amount_is_paid' => $filtered_results['total_amount']['is_paid'] ?? 0,
            'total_amount_is_not_paid' => $filtered_results['total_amount']['is_not_paid'] ?? 0,
        ]);
    }
}
