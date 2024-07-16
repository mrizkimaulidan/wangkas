<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use App\Models\Student;
use App\Services\CashTransactionService;
use Illuminate\Contracts\View\View;

class CashTransactionController extends Controller
{
    public function __construct(
        private CashTransactionService $cashTransactionService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
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

        $studentsPaidThisWeekIds = CashTransaction::whereBetween('date_paid', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString(),
        ])->pluck('student_id');

        $studentsPaidThisWeek = $students->filter(function (Student $student) use ($studentsPaidThisWeekIds) {
            return $studentsPaidThisWeekIds->contains($student->id);
        })->sortBy('name');

        $studentsNotPaidThisWeek = $students->reject(function (Student $student) use ($studentsPaidThisWeekIds) {
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
                'thisWeek' => CashTransaction::localizationAmountFormat($totalThisWeek),
                'thisYear' => CashTransaction::localizationAmountFormat($totalThisYear),
            ],
            'dateRange' => [
                'start' => now()->startOfWeek()->format('d-m-Y'),
                'end' => now()->endOfWeek()->format('d-m-Y'),
            ],
        ];

        return view('cash_transactions.index', compact('cashTransaction', 'students'));
    }

    /**
     * Export the resource to excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();

        return $this->cashTransactionService->export($startDate, $endDate);
    }
}
