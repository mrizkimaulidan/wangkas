<?php

namespace App\Http\Controllers;

use App\Repositories\SchoolMajorRepository;
use Illuminate\Http\Request;

class SchoolMajorController extends Controller
{
    public function __construct(
        private SchoolMajorRepository $schoolMajorRepository
    ) {
    }

    public function index()
    {
        return view('school_majors.index', [
            'school_majors' => $this->schoolMajorRepository->schoolMajorsOrderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->schoolMajorRepository->store($request);

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->schoolMajorRepository->update($request, $id);

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $this->schoolMajorRepository->findSchoolMajor($id)->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil dihapus!');
    }
}
