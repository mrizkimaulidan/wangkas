<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id): JsonResponse
    {
        $student = new StudentResource(Student::with('school_classes', 'school_majors')->findOrFail($id));

        return response()->success($student, Response::HTTP_OK);
    }
}
