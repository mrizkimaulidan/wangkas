<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchoolClassController extends Controller
{
    public function __construct(
        private SchoolClassRepository $schoolClassRepository
    ) {
    }

    public function show(SchoolClass $kela)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $this->schoolClassRepository->findSchoolClass($kela)], Response::HTTP_OK);
    }
}
