<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClassStoreRequest;
use App\Http\Requests\SchoolClassUpdateRequest;
use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function __construct(
        private SchoolClassRepository $schoolClassRepository
    ) {
    }

    public function index()
    {
        return view('school_classes.index', [
            'school_classes' => $this->schoolClassRepository->schoolClassesOrderBy('name')->get()
        ]);
    }

    public function store(SchoolClassStoreRequest $request)
    {
        $this->schoolClassRepository->store($request);

        return redirect()->route('kelas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(SchoolClassUpdateRequest $request, SchoolClass $kela)
    {
        $this->schoolClassRepository->update($request, $kela);

        return redirect()->route('kelas.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(SchoolClass $kela)
    {
        $school_class = $this->schoolClassRepository->findSchoolClass($kela);

        if ($school_class->students()->exists()) {
            return redirect()->route('kelas.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_class->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
