<?php

namespace App\Http\Controllers;

use App\Repositories\SchoolClassRepository;
use App\Repositories\SchoolMajorRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository,
        private SchoolClassRepository $schoolClassRepository,
        private SchoolMajorRepository $schoolMajorRepository,
    ) {
    }

    public function index()
    {
        return view('students.index', [
            'students' => $this->studentRepository->studentsOrderBy('name')->get(),
            'school_classes' => $this->schoolClassRepository->schoolClassesOrderBy('name')->get(),
            'school_majors' => $this->schoolMajorRepository->schoolMajorsOrderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->studentRepository->store($request);

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->studentRepository->update($request, $id);

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $this->studentRepository->findStudent($id)->delete();

        return redirect()->route('pelajar.index')->with('success', 'Data berhasil dihapus!');
    }
}
