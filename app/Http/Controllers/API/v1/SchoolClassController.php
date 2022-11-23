<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolClassEditResource;
use App\Http\Resources\SchoolClassShowResource;
use App\Models\SchoolClass;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SchoolClassController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $school_class = new SchoolClassShowResource(SchoolClass::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $school_class
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $school_class = new SchoolClassEditResource(SchoolClass::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $school_class
        ]);
    }
}
