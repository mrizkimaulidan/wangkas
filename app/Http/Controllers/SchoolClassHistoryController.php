<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\SchoolClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $schoolClasses = SchoolClass::select('id', 'name')->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($schoolClasses)
                ->addIndexColumn()
                ->addColumn('action', 'school_classes.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('school_classes.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        SchoolClass::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('school-classes.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        SchoolClass::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('school-classes.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
