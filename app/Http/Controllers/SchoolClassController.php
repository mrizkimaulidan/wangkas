<?php

namespace App\Http\Controllers;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return view('school_classes.index');
    }
}
