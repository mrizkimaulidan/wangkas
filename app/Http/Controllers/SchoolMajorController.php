<?php

namespace App\Http\Controllers;

use App\Exports\SchoolMajorsExport;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('school_majors.index');
    }

    /**
     * Export the resource to excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return (new SchoolMajorsExport)->download('jurusan.xlsx');
    }
}
