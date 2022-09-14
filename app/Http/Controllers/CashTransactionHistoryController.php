<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CashTransaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CashTransactionHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        // TODO: Date column on view should be DD-MM-YYYY format!
        $cashTransactions = CashTransaction::select('id', 'student_id', 'date')->with('students:id,name')
            ->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($cashTransactions)
                ->addIndexColumn()
                ->addColumn('action', 'cash_transactions.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('cash_transactions.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        CashTransaction::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('cash-transactions.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        CashTransaction::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('cash-transactions.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
