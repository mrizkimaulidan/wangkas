<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $schoolClasses = SchoolClass::select('id', 'name');

        return datatables()->of($schoolClasses)
            ->addIndexColumn()
            ->orderColumn('DT_RowIndex', false)
            ->blacklist(['DT_RowIndex'])
            ->addColumn('action', 'school_classes.datatables.action')
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
        ];

        $messages = [
            'name.required' => 'Kolom nama harus diisi',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $schoolClass = SchoolClass::create($validator->validated());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $schoolClass,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SchoolClass $schoolClass
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(SchoolClass $schoolClass): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolClass,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SchoolClass $schoolClass
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, SchoolClass $schoolClass): JsonResponse
    {
        $rules = [
            'name' => 'required|string|min:3|max:255|unique:school_classes,name,' . $schoolClass->id,
        ];

        $messages = [
            'name.required' => 'Kolom nama harus diisi',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',
            'name.unique' => 'Nama sudah digunakan!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $schoolClass->update($validator->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $schoolClass,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SchoolClass $schoolClass
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SchoolClass $schoolClass): JsonResponse
    {
        if ($schoolClass->students()->exists()) {
            return response()->json([
                'code' => Response::HTTP_CONFLICT,
                'message' => 'Data kelas tersebut terkait dengan pelajar, tidak dapat dihapus!',
            ], Response::HTTP_CONFLICT);
        }

        $schoolClass->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
