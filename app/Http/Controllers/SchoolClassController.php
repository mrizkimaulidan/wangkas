<?php

namespace App\Http\Controllers;

use App\Exports\SchoolClassesExport;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('school_classes.index');
    }

    /**
     * Export the resource to excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return (new SchoolClassesExport)->download('kelas.xlsx');
    }
}
