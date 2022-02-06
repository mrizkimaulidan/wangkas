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

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        $amountThisMonth = indonesian_currency($this->cashTransactionRepository->sumAmountBy('month', month: date('m')));

        $latestCashTransactions = $this->cashTransactionRepository
            ->cashTransactionLatest(['id', 'student_id', 'user_id', 'bill', 'amount', 'date'], 5);

        return view('dashboard.index', [
            'studentCount' => Student::count(),
            'schoolClassCount' => SchoolClass::count(),
            'schoolMajorCount' => SchoolMajor::count(),
            'amountThisMonth' => $amountThisMonth,
            'latestCashTransactions' => $latestCashTransactions
        ]);
    }
}
