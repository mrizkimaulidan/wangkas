<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    public function index(): View
    {
        $students = Student::with('school_classes:id,name', 'school_majors:id,name,abbreviated_word')
            ->select(
                'id',
                'school_class_id',
                'school_major_id',
                'student_identification_number',
                'name',
                'school_year_start',
                'school_year_end'
            )
            ->orderBy('name')
            ->get();

        $school_classes = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $school_majors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();

        $count_students_trashed = Student::onlyTrashed()->count();
        $count_male_student = $this->studentRepository->countStudentGender(1);
        $count_female_student = $this->studentRepository->countStudentGender(2);

        return view('students.index', [
            'students' => $students,
            'school_classes' => $school_classes,
            'school_majors' => $school_majors,
            'count_students_trashed' => $count_students_trashed,
            'count_male_student' => $count_male_student,
            'count_female_student' => $count_female_student,
        ]);
    }

    public function store(StudentStoreRequest $request): RedirectResponse
    {
        Student::create($request->validated());

        return redirect()->route('students.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(StudentUpdateRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return redirect()->route('students.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data berhasil dihapus!');
    }
}
