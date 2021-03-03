<?php

namespace App\Http\Controllers;

use App\Repositories\CashTransactionReportRepository;
use Illuminate\Http\Request;

class CashTransactionReportController extends Controller
{
    public function __construct(
        private  CashTransactionReportRepository $cashTransactionReportRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sum_this_day = $this->cashTransactionReportRepository->sumAmount('amount', 'this_day');
        $sum_this_week = $this->cashTransactionReportRepository->sumAmount('amount', 'this_week');
        $sum_this_month = $this->cashTransactionReportRepository->sumAmount('amount', 'this_month');
        $sum_this_year = $this->cashTransactionReportRepository->sumAmount('amount', 'this_year');

        return view('reports.index', compact('sum_this_day', 'sum_this_week', 'sum_this_month', 'sum_this_year'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
