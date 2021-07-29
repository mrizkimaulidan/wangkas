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
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Data berhasil diambil!',
            'data' => new SchoolMajorResource(SchoolMajor::findOrFail($id))
        ], Response::HTTP_OK);
    }
}
