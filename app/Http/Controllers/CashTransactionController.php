<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashTransactionStoreRequest;
use App\Http\Requests\CashTransactionUpdateRequest;
use App\Models\CashTransaction;
use App\Models\Student;
use App\Repositories\CashTransactionRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CashTransactionController extends Controller
{
    const INDEX_ROUTE = 'cash-transactions.index';

    public function __construct(
        private CashTransactionRepository $cashTransactionRepository
    ) {
    }

    public function index()
    {
        $cash_transactions = CashTransaction::with('students:id,name')
            ->select('id', 'student_id', 'bill', 'amount', 'date', 'is_paid')
            ->latest()
            ->get();

        if (request()->ajax()) {
            return datatables()->of($cash_transactions)
                ->addIndexColumn()
                ->addColumn('bill', function ($model) {
                    return indonesian_currency($model->bill);
                })
                ->addColumn('amount', function ($model) {
                    return indonesian_currency($model->amount);
                })
                ->addColumn('date', function ($model) {
                    return date('d-m-Y', strtotime($model->date));
                })
                ->addColumn('status', 'cash_transactions.datatable.status')
                ->addColumn('action', 'cash_transactions.action')
                ->rawColumns(['status', 'action'])
                ->toJson();
        }

        return view('cash_transactions.index', [
            'students' => Student::select('id', 'student_identification_number', 'name')->orderBy('name')->get(),
            'has_paid_count' => $this->cashTransactionRepository->countPaidOrNotPaid(true),
            'has_not_paid_count' => $this->cashTransactionRepository->countPaidOrNotPaid(false),
            'count_student_who_paid_this_week' => $this->cashTransactionRepository->countStudentWhoPaidOrNotPaidThisWeek(true),
            'count_student_who_not_paid_this_week' => $this->cashTransactionRepository->countStudentWhoPaidOrNotPaidThisWeek(false),
            'students_who_not_paid_this_week_by_limit' => $this->cashTransactionRepository->getStudentWhoNotPaidThisWeek(6),
            'total_this_year' => indonesian_currency($this->cashTransactionRepository->sumAmountBy('year', year: date('Y'))),
            'total_this_month' => indonesian_currency($this->cashTransactionRepository->sumAmountBy('month', month: date('m'))),
            'get_all_students_who_not_paid_this_week' => $this->cashTransactionRepository->getStudentWhoNotPaidThisWeek(),
        ]);
    }

    public function store(CashTransactionStoreRequest $request): RedirectResponse
    {
        Auth::user()->cash_transactions()->create($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil ditambahkan!');
    }

    public function update(CashTransactionUpdateRequest $request, CashTransaction $cashTransaction): RedirectResponse
    {
        $cashTransaction->update($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil diubah!');
    }

    public function destroy(CashTransaction $cashTransaction): RedirectResponse
    {
        $cashTransaction->delete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
