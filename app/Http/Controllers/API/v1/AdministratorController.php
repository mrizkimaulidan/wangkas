<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\AdministratorRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorController extends Controller
{
    public function __construct(
        private AdministratorRepository $administratorRepository
    ) {
    }

    public function show(string $id)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Data berhasil diambil!',
            'data' => User::select('id', 'name', 'email', 'password')->findOrFail($id)
        ], Response::HTTP_OK);
    }
}
