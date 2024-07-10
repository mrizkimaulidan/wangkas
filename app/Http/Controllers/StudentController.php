<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $schoolClasses = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation')->orderBy('name')->get();

        $genderCounts = $this->studentRepository->countStudentGender();
        $studentWithMajors = SchoolMajor::select('name', 'abbreviation')
            ->withCount('students')
            ->get();

        return view('students.index', compact('schoolClasses', 'schoolMajors', 'genderCounts', 'studentWithMajors'));
    }

    /**
     * Export the resource to excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return (new StudentsExport)->download('pelajar.xlsx');
    }
}
