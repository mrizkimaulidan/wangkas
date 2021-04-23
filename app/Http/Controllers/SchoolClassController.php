<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClassStoreRequest;
use App\Http\Requests\SchoolClassUpdateRequest;
use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $school_classes = SchoolClass::select('id', 'name')->orderBy('name')->get();

        return view('school_classes.index', compact('school_classes'));
    }

    public function store(SchoolClassStoreRequest $request)
    {
        SchoolClass::create([
            'name' => $request->name
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(SchoolClassUpdateRequest $request, string $id)
    {
        $school_class = SchoolClass::findOrFail($id);

        $school_class->update([
            'name' => $request->name
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(string $id)
    {
        $school_class = SchoolClass::findOrFail($id);

        if ($school_class->students()->exists()) {
            return redirect()->route('kelas.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_class->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
