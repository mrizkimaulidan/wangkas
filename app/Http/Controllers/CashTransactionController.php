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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cash_transactions.index', [
            'cash_transactions' => $this->cashTransactionRepository->cashTransactionLatest(),
            'students' => $this->studentRepository->studentsOrderBy('name')->get(),
            'has_paid_count' => $this->cashTransactionRepository->countPaidOrNotPaid(true),
            'has_not_paid_count' => $this->cashTransactionRepository->countPaidOrNotPaid(false),
            'total_this_month' => indonesian_currency($this->cashTransactionRepository->sumAmountFieldByYearAndMonth(year: date('Y'), month: date('m'))),
            'total_this_year' => indonesian_currency($this->cashTransactionRepository->sumAmountFieldByYearAndMonth(year: date('Y'))),
            'students_still_not_paid_by_limit' => $this->cashTransactionRepository->getStudentWhoStillNotPaid(6),
            'students_still_not_paid' => $this->cashTransactionRepository->getStudentWhoStillNotPaid()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->cashTransactionRepository->store($request);

        return redirect()->route('admin.kas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->cashTransactionRepository->update($request, $id);

        return redirect()->route('admin.kas.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cashTransactionRepository->findCashTransaction($id)->delete();

        return redirect()->route('admin.kas.index')->with('success', 'Data berhasil dihapus!');
    }
}
