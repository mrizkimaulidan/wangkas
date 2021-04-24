<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashTransactionStoreRequest;
use App\Http\Requests\CashTransactionUpdateRequest;
use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use App\Repositories\CashTransactionRepository;

class CashTransactionController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository
    ) {
    }

    public function index()
    {
        return view('cash_transactions.index', [
            'cash_transactions' => CashTransaction::with('students:id,name')->select('id', 'student_id', 'bill', 'amount', 'date', 'is_paid')->get(),
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

    public function store(CashTransactionStoreRequest $request)
    {
        CashTransaction::create([
            'user_id' => auth()->user()->id,
            'student_id' => $request->student_id,
            'bill' => $request->bill,
            'amount' => $request->amount,
            'is_paid' => $request->is_paid,
            'date' => date('Y-m-d', strtotime($request->date)),
            'note' => $request->note
        ]);

        return redirect()->route('kas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(CashTransactionUpdateRequest $request, string $id)
    {
        $cash_transaction = CashTransaction::findOrFail($id);

        $cash_transaction->update([
            'user_id' => auth()->user()->id,
            'student_id' => $request->student_id,
            'bill' => $request->bill,
            'amount' => $request->amount,
            'is_paid' => $request->is_paid,
            'date' => date('Y-m-d', strtotime($request->date)),
            'note' => $request->note
        ]);

        return redirect()->route('kas.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        CashTransaction::findOrFail($id)->delete();

        return redirect()->route('kas.index')->with('success', 'Data berhasil dihapus!');
    }
}
