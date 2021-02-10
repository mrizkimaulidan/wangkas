<?php

namespace App\Http\Controllers;

use App\Repositories\CashTransactionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository,
        private StudentRepository $studentRepository,
    ) {
    }

    public function index()
    {
        return view('admin.cash_transactions.index', [
            'cash_transactions' => $this->cashTransactionRepository->cashTransactionLatest(),
            'students' => $this->studentRepository->studentsOrderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->cashTransactionRepository->store($request);

        return redirect()->route('admin.kas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->cashTransactionRepository->update($request, $id);

        return redirect()->route('admin.kas.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $this->cashTransactionRepository->findCashTransaction($id)->delete();

        return redirect()->route('admin.kas.index')->with('success', 'Data berhasil dihapus!');
    }
}
