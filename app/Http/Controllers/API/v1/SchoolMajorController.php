<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolMajorResource;
use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SchoolMajorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id): JsonResponse
    {
        $school_major = new SchoolMajorResource(SchoolMajor::findOrFail($id));

        return response()->success($school_major, Response::HTTP_OK);
    }
}
