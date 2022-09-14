<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $students = Student::select(
            'id',
            'student_identification_number',
            'name',
            'school_class_id',
            'school_major_id',
            'school_year_start',
            'school_year_end'
        )->with(['school_class:id,name', 'school_major:id,name,abbreviated_word'])->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn(
                    'school_class_id',
                    fn ($model) => $model->school_class->name
                )
                ->addColumn('school_major', 'students.datatable.school_major')
                ->addColumn('school_year', 'students.datatable.school_year')
                ->addColumn('action', 'students.history.datatable.action')
                ->rawColumns(['action', 'school_major', 'school_year'])
                ->toJson();
        }

        return view('students.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Student::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('students.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->cash_transactions()->delete();
        $student->forceDelete();

        return redirect()->route('students.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
