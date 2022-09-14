<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolMajorHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviated_word')->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($schoolMajors)
                ->addIndexColumn()
                ->addColumn('abbreviated_word', 'school_majors.history.datatable.abbreviated_word')
                ->addColumn('action', 'school_majors.history.datatable.action')
                ->rawColumns(['abbreviated_word', 'action'])
                ->toJson();
        }

        return view('school_majors.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        SchoolMajor::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('school-majors.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        SchoolMajor::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('school-majors.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
