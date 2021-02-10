<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClass\StoreSchoolClassRequest;
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
        return view('admin.school_classes.index', [
            'school_classes' => $this->schoolClassRepository->schoolClassesOrderBy('name')->get()
        ]);
    }

    public function store(StoreSchoolClassRequest $request)
    {
        $this->schoolClassRepository->store($request);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->schoolClassRepository->update($request, $id);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $school_class = $this->schoolClassRepository->findSchoolClass($id);

        if ($school_class->students()->exists()) {
            return redirect()->route('admin.kelas.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_class->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
