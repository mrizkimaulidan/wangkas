<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Repositories\CashTransactionRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository,
    ) {
    }

    public function index(): View
    {
        return view('dashboard.index', [
            'student_count' => Student::count(),
            'school_class_count' => SchoolClass::count(),
            'school_major_count' => SchoolMajor::count(),
            'cash_transaction_this_month' => indonesian_currency($this->cashTransactionRepository->sumAmountBy('month', month: date('m'))),
            'latest_cash_transactions_by_limit' => $this->cashTransactionRepository->cashTransactionLatest(['student_id', 'user_id', 'bill', 'amount', 'date'], 5)
        ]);
    }
}
