<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolMajorRequest;
use App\Http\Requests\UpdateSchoolMajorRequest;
use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation');

        return datatables()->of($schoolMajors)
            ->addIndexColumn()
            ->orderColumn('DT_RowIndex', false)
            ->blacklist(['DT_RowIndex'])
            ->addColumn('action', 'school_majors.datatables.action')
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSchoolMajorRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSchoolMajorRequest $request): JsonResponse
    {
        $schoolMajor = SchoolMajor::create($request->validated());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $schoolMajor,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SchoolMajor $schoolMajor
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SchoolMajor $schoolMajor): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolMajor,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSchoolMajorRequest
     * @param \App\Models\SchoolMajor $schoolMajor
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSchoolMajorRequest $request, SchoolMajor $schoolMajor): JsonResponse
    {
        $schoolMajor->update($request->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolMajor,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SchoolMajor $schoolMajor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SchoolMajor $schoolMajor): JsonResponse
    {
        if ($schoolMajor->students()->exists()) {
            return response()->json([
                'code' => Response::HTTP_CONFLICT,
                'message' => 'Data jurusan tersebut terkait dengan pelajar, tidak dapat dihapus!',
            ], Response::HTTP_CONFLICT);
        }

        $schoolMajor->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
