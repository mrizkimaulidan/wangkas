<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::with('school_classes', 'school_majors')
            ->select(
                'id',
                'school_class_id',
                'school_major_id',
                'student_identification_number',
                'name',
                'school_year_start',
                'school_year_end'
            )
            ->get();

        $school_classes = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $school_majors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();

        return view('students.index', compact('students', 'school_classes', 'school_majors'));
    }

    public function store(StudentStoreRequest $request): RedirectResponse
    {
        Student::create([
            'school_class_id' => $request->school_class_id,
            'school_major_id' => $request->school_major_id,
            'student_identification_number' => $request->student_identification_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'school_year_start' => $request->school_year_start,
            'school_year_end' => $request->school_year_end
        ]);

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(StudentUpdateRequest $request, string $id): RedirectResponse
    {
        $student = Student::findOrFail($id);

        $student->update([
            'school_class_id' => $request->school_class_id,
            'school_major_id' => $request->school_major_id,
            'student_identification_number' => $request->student_identification_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'school_year_start' => $request->school_year_start,
            'school_year_end' => $request->school_year_end
        ]);

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(string $id): RedirectResponse
    {
        Student::findOrFail($id)->delete();

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil dihapus!');
    }
}
