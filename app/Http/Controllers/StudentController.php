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
    const INDEX_ROUTE = 'students.index';

    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    public function index()
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

        if (request()->ajax()) {
            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn('school_class_id', function ($model) {
                    return $model->school_classes->name;
                })
                ->addColumn('school_major', 'students.datatable.school_major')
                ->addColumn('school_year', 'students.datatable.school_year')
                ->addColumn('action', 'students.datatable.action')
                ->rawColumns(['action', 'school_major', 'school_year'])
                ->toJson();
        }

        $school_classes = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $school_majors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();

        $count_students_trashed = Student::onlyTrashed()->count();
        $count_male_student = $this->studentRepository->countStudentGender(1);
        $count_female_student = $this->studentRepository->countStudentGender(2);

        return view('students.index', [
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

        return redirect()->success('students.index', 'Data berhasil ditambahkan!');
    }

    public function update(StudentUpdateRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return redirect()->success('students.index', 'Data berhasil diubah!');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->success('students.index', 'Data berhasil dihapus!');
    }
}
