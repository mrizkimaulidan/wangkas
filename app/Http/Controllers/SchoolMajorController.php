<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class SchoolMajorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return view('school_majors.index');
    }
}
