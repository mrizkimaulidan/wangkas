<?php

namespace App\Http\Controllers\API\v1;

use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\SchoolMajorEditResource;
use App\Http\Resources\SchoolMajorShowResource;

class SchoolMajorController extends Controller
{
    public function show(string $id): JsonResponse
    {
        $school_major = new SchoolMajorShowResource(SchoolMajor::findOrFail($id));

        return response()->success($school_major, Response::HTTP_OK);
    }

    public function edit(string $id): JsonResponse
    {
        $school_major = new SchoolMajorEditResource(SchoolMajor::findOrFail($id));

        return response()->success($school_major, Response::HTTP_OK);
    }
}
