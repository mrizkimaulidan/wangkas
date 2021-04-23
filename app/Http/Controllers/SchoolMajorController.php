<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMajorStoreRequest;
use App\Http\Requests\SchoolMajorUpdateRequest;
use App\Models\SchoolMajor;
use Illuminate\Http\Request;

class SchoolMajorController extends Controller
{
    public function index()
    {
        $school_majors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();

        return view('school_majors.index', compact('school_majors'));
    }

    public function store(SchoolMajorStoreRequest $request)
    {
        SchoolMajor::create([
            'name' => $request->name,
            'abbreviated_word' => $request->abbreviated_word
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(SchoolMajorUpdateRequest $request, string $id)
    {
        $school_major = SchoolMajor::findOrFail($id);

        $school_major->update([
            'name' => $request->name,
            'abbreviated_word' => $request->abbreviated_word
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(string $id)
    {
        $school_major = SchoolMajor::findOrFail($id);

        if ($school_major->students()->exists()) {
            return redirect()->route('jurusan.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_major->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil dihapus!');
    }
}
