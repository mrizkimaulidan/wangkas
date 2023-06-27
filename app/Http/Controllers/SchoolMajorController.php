<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolMajorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('school_majors.index');
    }
}
