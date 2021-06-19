<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolMajorHistoryController extends Controller
{
    public function index()
    {
        return view('school_majors.history.index', [
            'school_majors' => SchoolMajor::onlyTrashed()->get()
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        SchoolMajor::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('jurusan.index.history')->with('success', 'Data berhasil dikembalikan!');
    }
}
