<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return view('school_classes.index');
    }
}
