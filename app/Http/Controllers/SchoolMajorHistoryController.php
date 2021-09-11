<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolMajorHistoryController extends Controller
{
    const INDEX_ROUTE = 'school-majors.index.history';

    public function index()
    {
        $school_majors = SchoolMajor::onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($school_majors)
                ->addIndexColumn()
                ->addColumn('abbreviated_word', 'school_majors.history.datatable.abbreviated_word')
                ->addColumn('action', 'school_majors.history.action')
                ->rawColumns(['abbreviated_word', 'action'])
                ->toJson();
        }

        return view('school_majors.history.index');
    }

    public function restore(int $id): RedirectResponse
    {
        SchoolMajor::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dikembalikan!');
    }

    public function destroy(int $id): RedirectResponse
    {
        SchoolMajor::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
