<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $counts = [
            'students' => 0,
            'schoolClasses' => 0,
            'schoolMajors' => 0,
            'administrators' => 0,
        ];

        $counts['students'] = Student::count();
        $counts['schoolClasses'] = SchoolClass::count();
        $counts['schoolMajors'] = SchoolMajor::count();
        $counts['administrators'] = User::count();

        return view('dashboard', compact('counts'));
    }
}
