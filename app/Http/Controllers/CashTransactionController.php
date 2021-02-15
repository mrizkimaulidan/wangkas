<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashTransactionStoreRequest;
use App\Http\Requests\CashTransactionUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use App\Repositories\CashTransactionRepository;

class CashTransactionController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository,
        private StudentRepository $studentRepository,
    ) {
    }

    public function index()
    {
        return view('cash_transactions.index', [
            'cash_transactions' => $this->cashTransactionRepository->cashTransactionLatest(),
            'students' => $this->studentRepository->studentsOrderBy('name')->get(),
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
        $this->cashTransactionRepository->store($request);

        return redirect()->route('kas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(CashTransactionUpdateRequest $request, $id)
    {
        $this->cashTransactionRepository->update($request, $id);

        return redirect()->route('kas.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $this->cashTransactionRepository->findCashTransaction($id)->delete();

        return redirect()->route('kas.index')->with('success', 'Data berhasil dihapus!');
    }
}
