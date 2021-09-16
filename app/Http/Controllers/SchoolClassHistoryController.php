<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassHistoryController extends Controller
{
    const INDEX_ROUTE = 'school-classes.index.history';

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(SchoolClass::onlyTrashed()->get())
                ->addIndexColumn()
                ->addColumn('action', 'school_classes.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('school_classes.history.index');
    }

    public function restore(int $id): RedirectResponse
    {
        SchoolClass::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dikembalikan!');
    }

    public function destroy(int $id): RedirectResponse
    {
        SchoolClass::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
