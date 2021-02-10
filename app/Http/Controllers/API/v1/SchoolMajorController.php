<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\SchoolMajorRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchoolMajorController extends Controller
{
    public function __construct(
        private SchoolMajorRepository $schoolMajorRepository
    ) {
    }
    
    public function show($id)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $this->schoolMajorRepository->findSchoolMajor($id)], Response::HTTP_OK);
    }
}
