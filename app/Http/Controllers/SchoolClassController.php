<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolClassStoreRequest;
use App\Http\Requests\SchoolClassUpdateRequest;
use App\Models\SchoolClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SchoolClassStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SchoolClassStoreRequest $request): RedirectResponse
    {
        SchoolClass::create($request->validated());

        return redirect()->route('school-classes.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SchoolClassUpdateRequest  $request
     * @param  \App\Models\SchoolClass  $schoolClass
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SchoolClassUpdateRequest $request, SchoolClass $schoolClass): RedirectResponse
    {
        $schoolClass->update($request->validated());

        return redirect()->route('school-classes.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolClass  $schoolClass
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SchoolClass $schoolClass): RedirectResponse
    {
        if ($schoolClass->students()->exists()) {
            return redirect()->route('school-classes.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $schoolClass->delete();

        return redirect()->route('school-classes.index')->with('success', 'Data berhasil dihapus!');
    }
}
