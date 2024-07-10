<?php

namespace App\Http\Controllers;

use App\Exports\AdministratorsExport;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('administrators.index');
    }

    /**
     * Export the resource to excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return (new AdministratorsExport)->download('administrator.xlsx');
    }
}
