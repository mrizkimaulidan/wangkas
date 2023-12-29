<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $schoolClasses = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation')->orderBy('name')->get();

        $genderCounts = $this->studentRepository->countStudentGender();

        return view('students.index', compact('schoolClasses', 'schoolMajors', 'genderCounts'));
    }
}
