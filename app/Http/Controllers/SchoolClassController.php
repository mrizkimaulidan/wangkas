<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClassStoreRequest;
use App\Http\Requests\SchoolClassUpdateRequest;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    public function index(): View
    {
        $school_classes = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $count_school_classes_trashed = SchoolClass::onlyTrashed()->count();

        return view('school_classes.index', compact('school_classes', 'count_school_classes_trashed'));
    }

    public function store(SchoolClassStoreRequest $request): RedirectResponse
    {
        SchoolClass::create($request->validated());

        return redirect()->route('classes.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(SchoolClassUpdateRequest $request, SchoolClass $class): RedirectResponse
    {
        $class->update($request->validated());

        return redirect()->route('classes.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(SchoolClass $class): RedirectResponse
    {
        if ($class->students()->exists()) {
            return redirect()->route('classes.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $class->delete();

        return redirect()->route('kelas.index')->with('success', 'Data berhasil dihapus!');
    }
}
