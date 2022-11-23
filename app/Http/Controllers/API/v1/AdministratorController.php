<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdministratorEditResource;
use App\Http\Resources\AdministratorShowResource;

class AdministratorController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $user = new AdministratorShowResource(User::findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $user
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $user = new AdministratorEditResource(User::findOrFail($id));

        return response()->json([
            'code' => 200,
            'data' => $user
        ]);
    }
}
