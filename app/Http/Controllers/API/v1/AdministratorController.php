<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdministratorRequest;
use App\Http\Resources\API\v1\AdministratorResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
     * @param \App\Http\Requests\StoreAdministratorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAdministratorRequest $request): JsonResponse
    {
        $administrator = User::create($request->validated());

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
}
