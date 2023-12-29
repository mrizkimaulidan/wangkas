<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $schoolClasses = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation')->orderBy('name')->get();

        $genderCounts = $this->studentRepository->countStudentGender();

        return view('students.index', compact('schoolClasses', 'schoolMajors', 'genderCounts'));
    }
}
