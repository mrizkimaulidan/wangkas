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

    public function index(): View
    {
        return view('students.history.index', [
            'students' => Student::onlyTrashed()->get()
        ]);
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
