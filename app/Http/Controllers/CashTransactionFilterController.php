<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashTransactionFilterRequest;
use App\Models\CashTransaction;
use App\Models\Student;
use App\Repositories\CashTransactionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class CashTransactionFilterController extends Controller
{
    public function __construct(
        private CashTransactionRepository $cashTransactionRepository,
        private Collection $cashTransactionStatistics,
        private Collection $filteredResults
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\CashTransactionFilterRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(CashTransactionFilterRequest $request): View
    {
        $transactionSummaries = $this->cashTransactionRepository->calculateTransactionSums(2024);

        // transform amounts to local currency format
        $transactionSummaries->transform(fn (int $amount) => CashTransaction::localizationAmountFormat($amount));

        $this->cashTransactionStatistics->put('currentYearTotal', $transactionSummaries['year']);
        $this->cashTransactionStatistics->put('currentMonthTotal', $transactionSummaries['month']);
        $this->cashTransactionStatistics->put('currentWeekTotal', $transactionSummaries['week']);
        $this->cashTransactionStatistics->put('todayTotal', $transactionSummaries['today']);

        if ($request->query->count() > 0) {
            $this->applyFilters($request);
        }

        return view('cash_transactions.filter.index', [
            'cashTransactionStatistics' => $this->cashTransactionStatistics,
            'filteredResults' => $this->filteredResults
        ]);
    }

    /**
     * Apply filters to the cash transactions based on the request.
     *
     * @param \App\Http\Requests\CashTransactionFilterRequest $request
     * @return void
     */
    private function applyFilters(CashTransactionFilterRequest $request): void
    {
        $startDate = now()->parse($request->start_date);
        $endDate = now()->parse($request->end_date);

        $transactionsInRange = CashTransaction::select(
            'id',
            'student_id',
            'amount',
            'date_paid',
            'created_by'
        )->with('student:id,name', 'createdBy:id,name')
            ->whereBetween('date_paid', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get();

        $students = Student::select(
            'id',
            'school_class_id',
            'school_major_id',
            'name',
            'student_identification_number',
            'phone_number',
            'gender'
        )
            ->with('schoolClass:id,name', 'schoolMajor:id,name,abbreviation')
            ->orderBy('student_identification_number')
            ->get();

        $studentsWhoPaid = $students->whereIn('id', $transactionsInRange->pluck('student_id'))->sortBy('name');
        $studentsWhoDidNotPay = $students->whereNotIn('id', $transactionsInRange->pluck('student_id'))->sortBy('name');

        $this->filteredResults->put('transactions', $transactionsInRange);
        $this->filteredResults->put('studentsWhoPaid', $studentsWhoPaid);
        $this->filteredResults->put('studentsWhoDidNotPay', $studentsWhoDidNotPay);
        $this->filteredResults->put('studentsWhoPaidCount', $studentsWhoPaid->count());
        $this->filteredResults->put('studentsWhoDidNotPayCount', $studentsWhoDidNotPay->count());
        $this->filteredResults->put('totalAmount', CashTransaction::localizationAmountFormat($transactionsInRange->sum('amount')));
        $this->filteredResults->put('startDate', $startDate->format('d-m-Y'));
        $this->filteredResults->put('endDate', $endDate->format('d-m-Y'));
    }
}
