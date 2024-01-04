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
        if ($request->filter === 'students_count') {
            $result = SchoolMajor::select('name', 'abbreviation')
                ->withCount('students')->get();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'ok',
                'data' => $result
            ], Response::HTTP_OK);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
        ], Response::HTTP_OK);
    }
}
