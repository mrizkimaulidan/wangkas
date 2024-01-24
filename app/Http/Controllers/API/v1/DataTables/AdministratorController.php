<?php

namespace App\Http\Controllers\API\v1\DataTables;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\DataTables\AdministratorResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $administrators = User::select('id', 'name', 'email', 'created_at');

        return datatables()->of($administrators)
            ->addIndexColumn()
            ->orderColumn('DT_RowIndex', false)
            ->blacklist(['DT_RowIndex'])
            ->editColumn('created_at', function ($administrator) {
                return $administrator->created_at->format('d-m-Y H:i');
            })
            ->addColumn('action', 'administrators.datatables.action')
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
            'email' => 'required|email|min:3|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:3|max:255',
        ];

        $messages = [
            'name.required' => 'Kolom nama harus diisi!',
            'name.string' => 'Kolom nama harus berupa teks!',
            'name.min' => 'Panjang nama minimal :min karakter!',
            'name.max' => 'Panjang nama maksimal :max karakter!',

            'email.required' => 'Kolom email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.min' => 'Panjang email minimal :min karakter!',
            'email.max' => 'Panjang email maksimal :max karakter!',
            'email.unique' => 'Email sudah digunakan!',

            'password.required' => 'Kolom password harus diisi!',
            'password.string' => 'Kolom password harus berupa teks!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Panjang password minimal :min karakter!',
            'password.max' => 'Panjang password maksimal :max karakter!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $administrator = User::create($validator->validated());

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'success',
            'data' => $administrator,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $administrator
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $administrator): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => new AdministratorResource($administrator),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Illuminate\Http\Request $request
     * @param \App\Models\User $administrator
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $administrator): JsonResponse
    {
        $administrator->update($request->all());

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $administrator,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $administrator
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $administrator): JsonResponse
    {
        $administrator->delete();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
        ], Response::HTTP_OK);
    }
}
