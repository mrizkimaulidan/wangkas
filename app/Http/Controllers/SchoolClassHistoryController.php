<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassHistoryController extends Controller
{
    public function index(): View
    {
        return view('school_classes.history.index', [
            'school_classes' => SchoolClass::onlyTrashed()->get()
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        SchoolClass::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('kelas.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    public function destroy(int $id): RedirectResponse
    {
        SchoolClass::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('kelas.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
