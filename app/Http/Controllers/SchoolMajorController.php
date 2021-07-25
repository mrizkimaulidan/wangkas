<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolMajorStoreRequest;
use App\Http\Requests\SchoolMajorUpdateRequest;
use App\Models\SchoolMajor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolMajorController extends Controller
{
    public function index(): View
    {
        $school_majors = SchoolMajor::select('id', 'name', 'abbreviated_word')->orderBy('name')->get();
        $count_school_majors_trashed = SchoolMajor::onlyTrashed()->count();

        return view('school_majors.index', compact('school_majors', 'count_school_majors_trashed'));
    }

    public function store(SchoolMajorStoreRequest $request): RedirectResponse
    {
        SchoolMajor::create($request->validated());

        return redirect()->route('majors.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(SchoolMajorUpdateRequest $request, SchoolMajor $major): RedirectResponse
    {
        $major->update($request->validated());

        return redirect()->route('majors.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(SchoolMajor $major): RedirectResponse
    {
        if ($major->students()->exists()) {
            return redirect()->route('majors.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $major->delete();

        return redirect()->route('majors.index')->with('success', 'Data berhasil dihapus!');
    }
}
