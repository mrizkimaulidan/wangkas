<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashTransactions = CashTransaction::select('id', 'student_id', 'amount', 'date_paid', 'created_by')
            ->with('student:id,name', 'createdBy:id,name')
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
        // TODO: the created_by should dynamic ID from authenticated user!
        $cashTransaction = CashTransaction::create($request->merge(['created_by' => 1])->all());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $cashTransaction,
        ], Response::HTTP_CREATED);
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
    public function destroy(CashTransaction $cashTransaction)
    {
        $cashTransaction->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
