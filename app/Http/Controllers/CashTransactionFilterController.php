<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashTransactionFilterRequest;
use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Contracts\View\View;

class CashTransactionFilterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Http\Requests\CashTransactionFilterRequest
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(CashTransactionFilterRequest $request): View
    {
        $cashTransactions = [];

        if ($request->has(['start_date', 'end_date'])) {
            $startDate = now()->parse($request->start_date);
            $endDate = now()->parse($request->end_date);

            $filteredResult = CashTransaction::with(['student:id,name', 'createdBy:id,name'])
                ->whereBetween('date_paid', [$startDate, $endDate])
                ->get();

            $students = Student::select('id', 'name', 'student_identification_number')
                ->orderBy('student_identification_number')->get();

            $studentsPaid = $students->filter(function (Student $student) use ($filteredResult) {
                return $filteredResult->pluck('student_id')->contains($student->id);
            })->sortBy('name');

            $studentsNotPaid = $students->reject(function (Student $student) use ($filteredResult) {
                return $filteredResult->pluck('student_id')->contains($student->id);
            })->sortBy('name');

            $cashTransactions = [
                'filteredResult' => $filteredResult,
                'studentsPaid' => $studentsPaid,
                'studentsNotPaid' => $studentsNotPaid,
                'studentsPaidCount' => $studentsPaid->count(),
                'studentsNotPaidCount' => $studentsNotPaid->count(),
                'sum' => CashTransaction::localizationAmountFormat($filteredResult->sum('amount')),
                'dateRange' => [
                    'start' => $startDate->format('d-m-Y'),
                    'end' => $endDate->format('d-m-Y'),
                ],
            ];
        }

        return view('cash_transactions.filter.index', compact('cashTransactions'));
    }
}
