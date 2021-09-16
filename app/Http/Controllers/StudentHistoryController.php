<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentHistoryController extends Controller
{
    const INDEX_ROUTE = 'students.index.history';

    public function index()
    {
        $students = Student::onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($students)
                ->addIndexColumn()
                ->addColumn(
                    'school_class_id',
                    fn ($model) => $model->school_classes->name
                )
                ->addColumn('school_major', 'students.datatable.school_major')
                ->addColumn('school_year', 'students.datatable.school_year')
                ->addColumn('action', 'students.history.datatable.action')
                ->rawColumns(['action', 'school_major', 'school_year'])
                ->toJson();
        }

        return view('students.history.index');
    }

    public function restore(string $id): RedirectResponse
    {
        Student::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dikembalikan!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->cash_transactions()->delete();
        $student->forceDelete();

        return redirect()->success(self::INDEX_ROUTE, 'Data berhasil dihapus!');
    }
}
