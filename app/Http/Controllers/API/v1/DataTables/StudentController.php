<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::select(
            'id',
            'school_class_id',
            'school_major_id',
            'student_identification_number',
            'name',
            'school_year_start',
            'school_year_end'
        )->with('schoolClass', 'schoolMajor')->get();

        return datatables()->of($students)
            ->addIndexColumn()
            ->addColumn('school_major', 'students.datatables.school_major')
            ->addColumn('school_year', 'students.datatables.school_year')
            ->addColumn('action', 'students.datatables.action')
            ->rawColumns(['school_major', 'school_year', 'action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
