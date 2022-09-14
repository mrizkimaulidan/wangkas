<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\ApiInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolClassEditResource;
use App\Http\Resources\SchoolClassShowResource;
use App\Models\SchoolClass;
use Illuminate\Http\JsonResponse;

class SchoolClassController extends Controller implements ApiInterface
{
    public function show(int $id): JsonResponse
    {
        $school_class = new SchoolClassShowResource(SchoolClass::findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $school_class
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $school_class = new SchoolClassEditResource(SchoolClass::findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $school_class
        ]);
    }
}
