<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\ApiInterface;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentEditResource;
use App\Http\Resources\StudentShowResource;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller implements ApiInterface
{
    public function show(int $id): JsonResponse
    {
        $student = new StudentShowResource(Student::with('school_class:id,name', 'school_major:id,name')->findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $student
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $student = new StudentEditResource(Student::with('school_class:id,name', 'school_major:id,name')->findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $student
        ]);
    }
}
