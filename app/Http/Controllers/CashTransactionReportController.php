<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashTransactionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cash_transactions.reports.index');
    }
}
