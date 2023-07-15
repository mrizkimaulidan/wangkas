<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('cash_transactions.index');
    }
}
