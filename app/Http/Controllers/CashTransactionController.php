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

        $studentsNotPaidThisWeek = Student::whereNotIn('id', function ($query) {
            $query->select('student_id')
                ->from('cash_transactions')
                ->whereBetween('date_paid', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString(),
                ]);
        })->orderBy('name')->get();

        $studentsPaidThisWeek = Student::whereIn('id', function ($query) {
            $query->select('student_id')
                ->from('cash_transactions')
                ->whereBetween('date_paid', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString(),
                ]);
        })->orderBy('name')->get();

        $query = CashTransaction::query();
        $cashTransaction = [
            'studentsNotPaidThisWeek' => $studentsNotPaidThisWeek,
            'studentsNotPaidThisWeekWithLimit' => $studentsNotPaidThisWeek->take(6),
            'studentsNotPaidThisWeekCount' => count($studentsNotPaidThisWeek),
            'studentsPaidThisWeekCount' => count($studentsPaidThisWeek),
            'total' => [
                'thisWeek' => $query->whereBetween('date_paid', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString(),
                ])->sum('amount'),
                'thisYear' => $query->whereBetween('date_paid', [
                    now()->startOfYear()->toDateString(),
                    now()->endOfYear()->toDateString(),
                ])->sum('amount'),
            ],
            'dateRange' => [
                'start' => now()->startOfWeek()->format('d-m-Y'),
                'end' => now()->endOfWeek()->format('d-m-Y'),
            ],
        ];

        return view('cash_transactions.index', compact('cashTransaction', 'students'));
    }
}
