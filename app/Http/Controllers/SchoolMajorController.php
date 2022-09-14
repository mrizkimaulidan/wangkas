<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMajorStoreRequest;
use App\Http\Requests\SchoolMajorUpdateRequest;
use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();

        if (request()->ajax()) {
            return datatables()->of($schoolMajors)
                ->addIndexColumn()
                ->addColumn('abbreviated_word', 'school_majors.datatable.abbreviated_word')
                ->addColumn('action', 'school_majors.datatable.action')
                ->rawColumns(['abbreviated_word', 'action'])
                ->toJson();
        }

        $schoolMajorTrashedCount = SchoolMajor::onlyTrashed()->count();

        return view('school_majors.index', compact('schoolMajorTrashedCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SchoolMajorStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SchoolMajorStoreRequest $request): RedirectResponse
    {
        SchoolMajor::create($request->validated());

        return redirect()->route('school-majors.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SchoolMajorUpdateRequest  $request
     * @param  \App\Models\SchoolMajor  $schoolMajor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SchoolMajorUpdateRequest $request, SchoolMajor $schoolMajor): RedirectResponse
    {
        $schoolMajor->update($request->validated());

        return redirect()->route('school-majors.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolMajor  $schoolMajor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SchoolMajor $schoolMajor): RedirectResponse
    {
        if ($schoolMajor->students()->exists()) {
            return redirect()->route('school-majors.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $schoolMajor->delete();

        return redirect()->route('school-majors.index')->with('success', 'Data berhasil dihapus!');
    }
}
