<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
    ) {
    }

    public function index()
    {
        return view('dashboard', [
            'student_count' => $this->studentRepository->studentsOrderBy('name')->count(),
            'school_class_count' => $this->schoolClassRepository->schoolClassesOrderBy('name')->count(),
            'school_major_count' => $this->schoolMajorRepository->schoolMajorsOrderBy('name')->count()
        ]);
    }
}
