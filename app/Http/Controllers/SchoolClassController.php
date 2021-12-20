<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClassStoreRequest;
use App\Http\Requests\SchoolClassUpdateRequest;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    const INDEX_ROUTE = 'school-classes.index';

    public function index()
    {
        $schoolClasses = SchoolClass::select('id', 'name')->orderBy('name')->get();

        if (request()->ajax()) {
            return datatables()->of($schoolClasses)
                ->addIndexColumn()
                ->addColumn('action', 'school_classes.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $schoolClassesTrashedCount = SchoolClass::onlyTrashed()->count();

        return view('school_classes.index', compact('schoolClassesTrashedCount'));
    }

    public function store(SchoolClassStoreRequest $request): RedirectResponse
    {
        SchoolClass::create($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil ditambahkan!');
    }

    public function update(SchoolClassUpdateRequest $request, SchoolClass $school_class): RedirectResponse
    {
        $school_class->update($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil diubah!');
    }

    public function destroy(SchoolClass $school_class): RedirectResponse
    {
        if ($school_class->students()->exists()) {
            return redirect()->warning(self::INDEX_ROUTE, 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_class->delete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
