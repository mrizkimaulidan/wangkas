<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SchoolMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $schoolMajors = SchoolMajor::select('id', 'name', 'abbreviation');

        return datatables()->of($schoolMajors)
            ->addIndexColumn()
            ->orderColumn('DT_RowIndex', false)
            ->blacklist(['DT_RowIndex'])
            ->addColumn('action', 'school_majors.datatables.action')
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'abbreviation' => 'required|string|min:1|max:255|unique:school_majors,abbreviation',
        ];

        $messages = [
            'name.required' => 'Kolom nama harus diisi',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'abbreviation.required' => 'Kolom singkatan harus diisi',
            'abbreviation.min' => 'Panjang singkatan minimal :min karakter!',
            'abbreviation.max' => 'Panjang singkatan maksimal :max karakter!',
            'abbreviation.unique' => 'Singkatan sudah digunakan!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $schoolMajor = SchoolMajor::create($validator->validated());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $schoolMajor,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SchoolMajor $schoolMajor
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SchoolMajor $schoolMajor): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolMajor,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request
     * @param \App\Models\SchoolMajor $schoolMajor
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, SchoolMajor $schoolMajor): JsonResponse
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'abbreviation' => 'required|string|min:1|max:255|unique:school_majors,abbreviation,' . $schoolMajor->id,
        ];

        $messages = [
            'name.required' => 'Kolom nama harus diisi',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'abbreviation.required' => 'Kolom singkatan harus diisi',
            'abbreviation.min' => 'Panjang singkatan minimal :min karakter!',
            'abbreviation.max' => 'Panjang singkatan maksimal :max karakter!',
            'abbreviation.unique' => 'Singkatan sudah digunakan!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $schoolMajor->update($validator->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolMajor,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SchoolMajor $schoolMajor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SchoolMajor $schoolMajor): JsonResponse
    {
        if ($schoolMajor->students()->exists()) {
            return response()->json([
                'code' => Response::HTTP_CONFLICT,
                'message' => 'Data jurusan tersebut terkait dengan pelajar, tidak dapat dihapus!',
            ], Response::HTTP_CONFLICT);
        }

        $schoolMajor->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
