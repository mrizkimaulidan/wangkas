<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }
    
    public function show($id)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $this->studentRepository->findStudent($id)], Response::HTTP_OK);
    }
}
