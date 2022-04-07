<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentEditResource;
use App\Http\Resources\StudentShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function show(int $id): JsonResponse
    {
        $student = new StudentShowResource(Student::with('school_class:id,name', 'school_major:id,name')->findOrFail($id));

        return response()->success($student, Response::HTTP_OK);
    }

    public function edit(int $id): JsonResponse
    {
        $student = new StudentEditResource(Student::with('school_class:id,name', 'school_major:id,name')->findOrFail($id));

        return response()->success($student, Response::HTTP_OK);
    }
}
