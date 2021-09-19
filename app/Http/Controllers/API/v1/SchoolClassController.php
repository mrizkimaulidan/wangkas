<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolClassEditResource;
use App\Http\Resources\SchoolClassShowResource;
use App\Models\SchoolClass;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SchoolClassController extends Controller
{
    public function show(string $id): JsonResponse
    {
        $school_class = new SchoolClassShowResource(SchoolClass::findOrFail($id));

        return response()->success($school_class, Response::HTTP_OK);
    }

    public function edit(string $id): JsonResponse
    {
        $school_class = new SchoolClassEditResource(SchoolClass::findOrFail($id));

        return response()->success($school_class, Response::HTTP_OK);
    }
}
