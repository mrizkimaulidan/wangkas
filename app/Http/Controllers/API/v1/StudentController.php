<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentEditResource;
use App\Http\Resources\StudentShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $student = new StudentShowResource(Student::with('school_class:id,name', 'school_major:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $student
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $student = new StudentEditResource(Student::with('school_class:id,name', 'school_major:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $student
        ]);
    }
}
