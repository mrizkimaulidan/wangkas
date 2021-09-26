<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;

class CashTransactionFilterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $start_date = date('Y-m-d', strtotime(request('start_date')));
        $end_date = date('Y-m-d', strtotime(request('end_date')));

        if (request()->ajax()) {
            return datatables()->of(CashTransaction::with('students:id,name', 'users:id,name')
                ->whereBetween('date', [$start_date, $end_date])->get())
                ->addIndexColumn()
                ->addColumn('bill', fn ($model) => indonesian_currency($model->bill))
                ->addColumn('amount', fn ($model) => indonesian_currency($model->amount))
                ->addColumn('date', fn ($model) => date('d-m-Y', strtotime($model->date)))
                ->addColumn('status', 'cash_transactions.datatable.status')
                ->rawColumns(['status'])
                ->toJson();
        }

        return view('cash_transactions.filter.index');
    }
}
