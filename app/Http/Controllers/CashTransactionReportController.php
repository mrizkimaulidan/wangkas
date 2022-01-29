<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
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
        $filteredResult = [];

        if (request()->has('start_date') && request()->has('end_date')) {
            $startDate = date('Y-m-d', strtotime(request()->get('start_date')));
            $endDate = date('Y-m-d', strtotime(request()->get('end_date')));

            $cashTransactions = CashTransaction::select('user_id', 'student_id', 'amount', 'date')
                ->with('students:id,name', 'users:id,name')
                ->whereBetween('date', [$startDate, $endDate])
                ->orderBy('date')->get();

            $filteredResult['cashTransactions'] = $cashTransactions;
            $filteredResult['sumOfAmount'] = $cashTransactions->sum('amount');
            $filteredResult['startDate'] = date('d-m-Y', strtotime($startDate));
            $filteredResult['endDate'] = date('d-m-Y', strtotime($endDate));
        }

        $sum = [
            'thisDay' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisDay')),
            'thisWeek' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisWeek')),
            'thisMonth' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisMonth')),
            'thisYear' => indonesian_currency($this->cashTransactionReportRepository->sum('amount', 'thisYear')),
        ];

        return view('reports.index', [
            'sum' => $sum,
            'filteredResult' => $filteredResult
        ]);
    }
}
