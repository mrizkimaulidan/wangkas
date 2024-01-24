<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\DataTables\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'school_class_id' => 'required|numeric|exists:school_classes,id',
            'school_major_id' => 'required|numeric|exists:school_majors,id',
            'student_identification_number' => 'required|numeric|unique:students,student_identification_number',
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:students,email',
            'phone_number' => 'required|numeric|digits_between:3,255|unique:students,phone_number',
            'gender' => 'required|numeric|in:1,2',
            'school_year_start' => 'required|numeric|digits_between:3,255',
            'school_year_end' => 'required|numeric|digits_between:3,255',
        ];

        $messages = [
            'school_class_id.required' => 'Kolom kelas harus diisi!',
            'school_class_id.numeric' => 'Kolom kelas harus berupa angka!',
            'school_class_id.exists' => 'Kelas yang dipilih tidak ditemukan!',

            'school_major_id.required' => 'Kolom jurusan harus diisi!',
            'school_major_id.numeric' => 'Kolom jurusan harus berupa angka!',
            'school_major_id.exists' => 'Jurusan yang dipilih tidak ditemukan!',

            'student_identification_number.required' => 'Kolom nomor identitas pelajar harus diisi!',
            'student_identification_number.numeric' => 'Kolom nomor identitas pelajar harus berupa angka!',
            'student_identification_number.unique' => 'Nomor identitas pelajar sudah digunakan!',

            'name.required' => 'Kolom nama harus diisi!',
            'name.string' => 'Kolom nama harus berupa teks!',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.min' => 'Panjang email minimal :min karakter!',
            'email.max' => 'Panjang email maksimal :max karakter!',
            'email.unique' => 'Email sudah digunakan!',

            'phone_number.required' => 'Kolom nomor telepon harus diisi!',
            'phone_number.numeric' => 'Kolom nomor telepon harus berupa angka!',
            'phone_number.digits_between' => 'Panjang nomor telepon harus antara :min dan :max digit!',
            'phone_number.unique' => 'Nomor telepon sudah digunakan!',

            'gender.required' => 'Kolom jenis kelamin harus diisi!',
            'gender.numeric' => 'Kolom jenis kelamin harus berupa angka!',
            'gender.in' => 'Jenis kelamin yang dipilih tidak valid!',

            'school_year_start.required' => 'Kolom tahun masuk harus diisi!',
            'school_year_start.numeric' => 'Kolom tahun masuk harus berupa angka!',
            'school_year_start.digits_between' => 'Panjang tahun masuk harus antara :min dan :max digit!',

            'school_year_end.required' => 'Kolom tahun lulus harus diisi!',
            'school_year_end.numeric' => 'Kolom tahun lulus harus berupa angka!',
            'school_year_end.digits_between' => 'Panjang tahun lulus harus antara :min dan :max digit!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $student = Student::create($validator->validated());

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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Student $student): JsonResponse
    {
        $rules = [
            'school_class_id' => 'required|numeric|exists:school_classes,id',
            'school_major_id' => 'required|numeric|exists:school_majors,id',
            'student_identification_number' => 'required|numeric|unique:students,student_identification_number,' . $student->id,
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:students,email,' . $student->id,
            'phone_number' => 'required|numeric|digits_between:3,255|unique:students,phone_number,' . $student->id,
            'gender' => 'required|numeric|in:1,2',
            'school_year_start' => 'required|numeric|digits_between:3,255',
            'school_year_end' => 'required|numeric|digits_between:3,255',
        ];

        $messages = [
            'school_class_id.required' => 'Kolom kelas harus diisi!',
            'school_class_id.numeric' => 'Kolom kelas harus berupa angka!',
            'school_class_id.exists' => 'Kelas yang dipilih tidak ditemukan!',

            'school_major_id.required' => 'Kolom jurusan harus diisi!',
            'school_major_id.numeric' => 'Kolom jurusan harus berupa angka!',
            'school_major_id.exists' => 'Jurusan yang dipilih tidak ditemukan!',

            'student_identification_number.required' => 'Kolom nomor identitas pelajar harus diisi!',
            'student_identification_number.numeric' => 'Kolom nomor identitas pelajar harus berupa angka!',
            'student_identification_number.unique' => 'Nomor identitas pelajar sudah digunakan!',

            'name.required' => 'Kolom nama harus diisi!',
            'name.string' => 'Kolom nama harus berupa teks!',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.min' => 'Panjang email minimal :min karakter!',
            'email.max' => 'Panjang email maksimal :max karakter!',
            'email.unique' => 'Email sudah digunakan!',

            'phone_number.required' => 'Kolom nomor telepon harus diisi!',
            'phone_number.numeric' => 'Kolom nomor telepon harus berupa angka!',
            'phone_number.digits_between' => 'Panjang nomor telepon harus antara :min dan :max digit!',
            'phone_number.unique' => 'Nomor telepon sudah digunakan!',

            'gender.required' => 'Kolom jenis kelamin harus diisi!',
            'gender.numeric' => 'Kolom jenis kelamin harus berupa angka!',
            'gender.in' => 'Jenis kelamin yang dipilih tidak valid!',

            'school_year_start.required' => 'Kolom tahun masuk harus diisi!',
            'school_year_start.numeric' => 'Kolom tahun masuk harus berupa angka!',
            'school_year_start.digits_between' => 'Panjang tahun masuk harus antara :min dan :max digit!',

            'school_year_end.required' => 'Kolom tahun lulus harus diisi!',
            'school_year_end.numeric' => 'Kolom tahun lulus harus berupa angka!',
            'school_year_end.digits_between' => 'Panjang tahun lulus harus antara :min dan :max digit!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $student->update($validator->validated());

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
