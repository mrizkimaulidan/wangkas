<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMajorStoreRequest;
use App\Http\Requests\SchoolMajorUpdateRequest;
use App\Models\SchoolMajor;
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

    public function store(SchoolMajorStoreRequest $request)
    {
        $this->schoolMajorRepository->store($request);

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(SchoolMajorUpdateRequest $request, SchoolMajor $jurusan)
    {
        $this->schoolMajorRepository->update($request, $jurusan);

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(SchoolMajor $jurusan)
    {
        $school_major = $this->schoolMajorRepository->findSchoolMajor($jurusan);

        if ($school_major->students()->exists()) {
            return redirect()->route('jurusan.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_major->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil dihapus!');
    }
}
