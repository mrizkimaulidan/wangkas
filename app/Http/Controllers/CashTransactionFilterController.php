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

            $filteredResult = CashTransaction::select(
                'id',
                'student_id',
                'amount',
                'created_by'
            )->with('student:id,name', 'createdBy:id,name')
                ->whereBetween('date_paid', [$startDate, $endDate])
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
                ->orderBy('student_identification_number')->get();

            $studentsPaid = $students->whereIn('id', $filteredResult->pluck('student_id'))->sortBy('name');
            $studentsNotPaid = $students->whereNotIn('id', $filteredResult->pluck('student_id'))->sortBy('name');

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
