<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\ApiInterface;
use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolMajorEditResource;
use App\Http\Resources\SchoolMajorShowResource;

class SchoolMajorController extends Controller implements ApiInterface
{
    public function show(int $id): JsonResponse
    {
        $school_major = new SchoolMajorShowResource(SchoolMajor::findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $school_major
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $school_major = new SchoolMajorEditResource(SchoolMajor::findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $school_major
        ]);
    }
}
