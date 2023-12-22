<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Http\Request;

class CashTransactionFilterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
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

            $studentsPaid = $students->filter(function ($student) use ($filteredResult) {
                return $filteredResult->pluck('student_id')->contains($student->id);
            })->sortBy('name');

            $studentsNotPaid = $students->reject(function ($student) use ($filteredResult) {
                return $filteredResult->pluck('student_id')->contains($student->id);
            })->sortBy('name');

            $cashTransactions = [
                'filteredResult' => $filteredResult,
                'studentsPaid' => $studentsPaid,
                'studentsNotPaid' => $studentsNotPaid,
                'studentsPaidCount' => $studentsPaid->count(),
                'studentsNotPaidCount' => $studentsNotPaid->count(),
                'sum' => $filteredResult->sum('amount'),
                'dateRange' => [
                    'start' => $startDate->format('d-m-Y'),
                    'end' => $endDate->format('d-m-Y'),
                ],
            ];
        }

        return view('cash_transactions.filter.index', compact('cashTransactions'));
    }
}
