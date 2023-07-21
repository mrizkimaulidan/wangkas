<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashTransactions = CashTransaction::select('id', 'student_id', 'amount', 'date_paid', 'created_by')
            ->with('student:id,name', 'user:id,name')
            ->whereYear('date_paid', now()->year)
            ->whereMonth('date_paid', now()->month)
            ->get();

        return datatables()->of($cashTransactions)
            ->addIndexColumn()
            ->addColumn('action', 'cash_transactions.datatables.action')
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
