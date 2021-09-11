<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMajorStoreRequest;
use App\Http\Requests\SchoolMajorUpdateRequest;
use App\Models\SchoolMajor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolMajorController extends Controller
{
    const INDEX_ROUTE = 'school-majors.index';

    public function index(): View
    {
        $school_majors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();
        $count_school_majors_trashed = SchoolMajor::onlyTrashed()->count();

        return view('school_majors.index', compact('school_majors', 'count_school_majors_trashed'));
    }

    public function store(SchoolMajorStoreRequest $request): RedirectResponse
    {
        SchoolMajor::create($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil ditambahkan!');
    }

    public function update(SchoolMajorUpdateRequest $request, SchoolMajor $major): RedirectResponse
    {
        $major->update($request->validated());

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil diubah!');
    }

    public function destroy(SchoolMajor $school_major): RedirectResponse
    {
        if ($school_major->students()->exists()) {
            return redirect()->warning(self::INDEX_ROUTE, 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $school_major->delete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
