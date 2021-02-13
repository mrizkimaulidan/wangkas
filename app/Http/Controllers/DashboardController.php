<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Repositories\CashTransactionRepository;
use App\Repositories\SchoolClassRepository;
use App\Repositories\SchoolMajorRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository,
        private SchoolClassRepository $schoolClassRepository,
        private SchoolMajorRepository $schoolMajorRepository,
        private CashTransactionRepository $cashTransactionRepository,
    ) {
    }

    public function index()
    {
        return view('dashboard', [
            'student_count' => count_data($this->studentRepository->studentsOrderBy('name')->get()),
            'school_class_count' => count_data($this->schoolClassRepository->schoolClassesOrderBy('name')->get()),
            'school_major_count' => count_data($this->schoolMajorRepository->schoolMajorsOrderBy('name')->get()),
            'cash_transaction_this_month' => indonesian_currency($this->cashTransactionRepository->sumAmountBy('month', month: date('m')))
        ]);
    }
}
