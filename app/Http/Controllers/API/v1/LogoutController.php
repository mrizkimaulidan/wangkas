<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success'
        ]);
    }
}
