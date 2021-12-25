<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\CashTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Repositories\CashTransactionRepository;
use App\Http\Requests\CashTransactionStoreRequest;
use App\Http\Requests\CashTransactionUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

class CashTransactionController extends Controller
{
    private $cashTransactionRepository, $startOfWeek, $endOfWeek;
    const INDEX_ROUTE = 'cash-transactions.index';

    public function __construct(CashTransactionRepository $cashTransactionRepository)
    {
        $this->cashTransactionRepository = $cashTransactionRepository;
        $this->startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = now()->endOfWeek()->format('Y-m-d');
    }

    public function index()
    {
        $cashTransactions = CashTransaction::with('students:id,name')
            ->select('id', 'student_id', 'bill', 'amount', 'date')
            ->whereBetween('date', [$this->startOfWeek, $this->endofWeek])
            ->latest()
            ->get();

        $students = Student::select('id', 'student_identification_number', 'name')
            ->whereDoesntHave(
                'cash_transactions',
                fn (Builder $query) => $query->select(['date'])
                    ->whereBetween('date', [$this->startOfWeek, $this->endofWeek])
            )->get();

        if (request()->ajax()) {
            return datatables()->of($cashTransactions)
                ->addIndexColumn()
                ->addColumn('bill', fn ($model) => indonesian_currency($model->bill))
                ->addColumn('amount', fn ($model) => indonesian_currency($model->amount))
                ->addColumn('date', fn ($model) => date('d-m-Y', strtotime($model->date)))
                ->addColumn('action', 'cash_transactions.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('cash_transactions.index', [
            'students' => $students,
            'data' => $this->cashTransactionRepository->results(),
        ]);
    }

    public function store(CashTransactionStoreRequest $request): RedirectResponse
    {
        foreach ($request->student_id as $student_id) {
            Auth::user()->cash_transactions()->create([
                'student_id' => $student_id,
                'bill' => $request->bill,
                'amount' => $request->amount,
                'date' => $request->date,
                'note' => $request->note
            ]);
        }

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
