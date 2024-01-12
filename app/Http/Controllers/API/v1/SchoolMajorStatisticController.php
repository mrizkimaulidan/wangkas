<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\SchoolMajor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SchoolMajorStatisticController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $response = [
            'code' => Response::HTTP_OK,
            'message' => 'ok'
        ];

        if ($request->filter === 'students_count') {
            $response['data'] = SchoolMajor::select('name', 'abbreviation')->withCount('students')->get();
        }

        return response()->json($response, Response::HTTP_OK);
    }
}
