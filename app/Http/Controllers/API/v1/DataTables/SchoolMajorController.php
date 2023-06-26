<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation')->get();

        return datatables()->of($schoolMajors)
            ->addIndexColumn()
            ->addColumn('action', 'school_majors.datatables.action')
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $schoolMajor = SchoolMajor::create($request->all());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $schoolMajor
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolMajor $schoolMajor)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolMajor
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolMajor $schoolMajor)
    {
        $schoolMajor->update($request->all());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolMajor
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolMajor $schoolMajor)
    {
        $schoolMajor->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
