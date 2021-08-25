<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClassStoreRequest;
use App\Http\Requests\SchoolClassUpdateRequest;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    // Route name for this classes
    const ROUTE = 'classes.index';

    public function index(): View
    {
        $school_classes = SchoolClass::select('id', 'name')->orderBy('name')->get();
        $count_school_classes_trashed = SchoolClass::onlyTrashed()->count();

        return view('school_classes.index', compact('school_classes', 'count_school_classes_trashed'));
    }

    public function store(SchoolClassStoreRequest $request): RedirectResponse
    {
        SchoolClass::create($request->validated());

        return redirect()->success(self::ROUTE, 'Data berhasil ditambahkan!');
    }

    public function update(SchoolClassUpdateRequest $request, SchoolClass $class): RedirectResponse
    {
        $class->update($request->validated());

        return redirect()->success(self::ROUTE, 'Data berhasil diubah!');
    }

    public function destroy(SchoolClass $class): RedirectResponse
    {
        if ($class->students()->exists()) {
            return redirect()->warning(self::ROUTE, 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $class->delete();

        return redirect()->success(self::ROUTE, 'Data berhasil dihapus!');
    }
}
