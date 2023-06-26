<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('school_majors.index');
    }
}
