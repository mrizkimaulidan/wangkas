<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMajorStoreRequest;
use App\Http\Requests\SchoolMajorUpdateRequest;
use App\Models\SchoolMajor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SchoolMajorController extends Controller
{
    const INDEX_ROUTE = 'school-majors.index';

    public function index()
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

    public function store(SchoolMajorStoreRequest $request): RedirectResponse
    {
        SchoolMajor::create($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil ditambahkan!');
    }

    public function update(SchoolMajorUpdateRequest $request, SchoolMajor $schoolMajor): RedirectResponse
    {
        $schoolMajor->update($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil diubah!');
    }

    public function destroy(SchoolMajor $schoolMajor): RedirectResponse
    {
        if ($schoolMajor->students()->exists()) {
            return redirect()->warning(self::INDEX_ROUTE, 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $schoolMajor->delete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
