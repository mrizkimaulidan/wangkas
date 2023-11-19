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
