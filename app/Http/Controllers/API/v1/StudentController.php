<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Data berhasil diambil!',
            'data' => Student::with('school_classes:id,name', 'school_majors:id,name')
                ->select(
                    'id',
                    'school_class_id',
                    'school_major_id',
                    'student_identification_number',
                    'name',
                    'gender',
                    'email',
                    'phone_number',
                    'school_year_start',
                    'school_year_end'
                )
                ->findOrFail($id)
        ], Response::HTTP_OK);
    }
}
