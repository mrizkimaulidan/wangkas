<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\AdministratorRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorController extends Controller
{
    public function __construct(
        private AdministratorRepository $administratorRepository
    ) {
    }
    
    public function show($id)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $this->administratorRepository->findAdministrator($id)], Response::HTTP_OK);
    }
}
