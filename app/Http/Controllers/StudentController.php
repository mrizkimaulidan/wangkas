<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $schoolClasses = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation')->orderBy('name')->get();

        $maleCount = Student::select('gender')->where('gender', 1)->count();
        $femaleCount = Student::select('gender')->where('gender', 2)->count();

        return view('students.index', compact('schoolClasses', 'schoolMajors', 'maleCount', 'femaleCount'));
    }
}
