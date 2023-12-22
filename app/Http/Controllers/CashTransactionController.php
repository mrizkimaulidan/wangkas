<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use App\Models\Student;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $students = Student::select('id', 'name', 'student_identification_number')
            ->orderBy('student_identification_number')->get();

        $studentsPaidThisWeekIds = CashTransaction::whereBetween('date_paid', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString(),
        ])->pluck('student_id');

        $studentsPaidThisWeek = $students->filter(function ($student) use ($studentsPaidThisWeekIds) {
            return $studentsPaidThisWeekIds->contains($student->id);
        })->sortBy('name');

        $studentsNotPaidThisWeek = $students->reject(function ($student) use ($studentsPaidThisWeekIds) {
            return $studentsPaidThisWeekIds->contains($student->id);
        })->sortBy('name');

        $totalThisWeek = CashTransaction::whereBetween('date_paid', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString(),
        ])->sum('amount');

        $totalThisYear = CashTransaction::whereBetween('date_paid', [
            now()->startOfYear()->toDateString(),
            now()->endOfYear()->toDateString(),
        ])->sum('amount');

        $cashTransaction = [
            'studentsNotPaidThisWeek' => $studentsNotPaidThisWeek,
            'studentsNotPaidThisWeekWithLimit' => $studentsNotPaidThisWeek->take(6),
            'studentsNotPaidThisWeekCount' => $studentsNotPaidThisWeek->count(),
            'studentsPaidThisWeekCount' => $studentsPaidThisWeek->count(),
            'total' => [
                'thisWeek' => $totalThisWeek,
                'thisYear' => $totalThisYear,
            ],
            'dateRange' => [
                'start' => now()->startOfWeek()->format('d-m-Y'),
                'end' => now()->endOfWeek()->format('d-m-Y'),
            ],
        ];

        return view('cash_transactions.index', compact('cashTransaction', 'students'));
    }
}
