<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\API\v1\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $students = Student::select(
            'id',
            'school_class_id',
            'school_major_id',
            'student_identification_number',
            'name',
            'school_year_start',
            'school_year_end'
        )->with('schoolClass:id,name', 'schoolMajor:id,name');

        return datatables()->of($students)
            ->addIndexColumn()
            ->blacklist(['DT_RowIndex'])
            ->orderColumn('DT_RowIndex', false)
            ->addColumn('school_class', 'students.datatables.school_class')
            ->addColumn('school_major', 'students.datatables.school_major')
            ->addColumn('school_year', 'students.datatables.school_year')
            ->addColumn('action', 'students.datatables.action')
            ->rawColumns(['school_class', 'school_major', 'school_year', 'action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStudentRequest $request
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $student,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Student $student): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => new StudentResource($student->load('schoolClass', 'schoolMajor')),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStudentRequest $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $student->update($request->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $student,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Student $student): JsonResponse
    {
        if ($student->cashTransactions()->exists()) {
            return response()->json([
                'code' => Response::HTTP_CONFLICT,
                'message' => 'Data pelajar tersebut terkait dengan transaksi kas, tidak dapat dihapus!',
            ], Response::HTTP_CONFLICT);
        }

        $student->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
