<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use Illuminate\Http\Request;

class CashTransactionReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cashTransactions = [];

        $cashTransactionsCurrentYear = CashTransaction::whereYear('date_paid', now()->year)->get();
        $cashTransactions['cashTransactionCurrentYearCount'] = $cashTransactionsCurrentYear->sum('amount');

        $cashTransactions['cashTransactionCurrentMonthCount'] = $cashTransactionsCurrentYear
            ->filter(function ($transaction) {
                $datePaid = now()->createFromFormat('Y-m-d', $transaction->date_paid);

                return (int) $datePaid->format('m') === now()->month;
            })->sum('amount');

        $cashTransactions['cashTransactionCurrentWeekCount'] = $cashTransactionsCurrentYear
            ->filter(function ($transaction) {
                return now()->createFromFormat('Y-m-d', $transaction->date_paid)
                    ->between(now()->startOfWeek()->toDateString(), now()->endOfWeek()->toDateString());
            })->sum('amount');

        $cashTransactions['cashTransactionTodayCount'] = $cashTransactionsCurrentYear
            ->filter(function ($transaction) {
                return now()->createFromFormat('Y-m-d', $transaction->date_paid)->isToday();
            })->sum('amount');

        if ($request->has('start_date') && $request->has('end_date')) {
            $cashTransactions['filteredResult'] = CashTransaction::with('student:id,name', 'createdBy:id,name')
                ->select('id', 'student_id', 'amount', 'date_paid', 'created_by')
                ->whereBetween('date_paid', [$request->start_date, $request->end_date])
                ->get();
            $cashTransactions['sum'] = $cashTransactions['filteredResult']->sum('amount');
        }

        return view('cash_transactions.reports.index', compact('cashTransactions'));
    }
}
