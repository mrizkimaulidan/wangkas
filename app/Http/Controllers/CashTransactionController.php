<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CashTransactionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentDate = now();
        $studentsNotPaidThisWeek = Student::whereNotIn('id', function ($query) use ($currentDate) {
            $query->select('student_id')
                ->from('cash_transactions')
                ->whereBetween('date_paid', [
                    $currentDate->startOfWeek()->toDateString(),
                    $currentDate->endOfWeek()->toDateString()
                ]);
        })->orderBy('name')->get();

        $cashTransaction = [
            'studentsNotPaidThisWeek' => $studentsNotPaidThisWeek,
            'studentsNotPaidThisWeekWithLimit' => $studentsNotPaidThisWeek->take(6),
            'studentsNotPaidThisWeekCount' => count($studentsNotPaidThisWeek)
        ];

        return view('cash_transactions.index', compact('cashTransaction'));
    }
}
