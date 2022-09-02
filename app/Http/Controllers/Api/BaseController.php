<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     *  success response
     *
     * @return \Illuminate\Http\Response
     */
    public function success($result, $message, $statusCode)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json(data: $response, status: $statusCode);
    }

    /**
     *  error response
     *
     * @return \Illuminate\Http\Response
     */
    public function error($error, $statusCode)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        return response()->json($response, $statusCode);
    }
}
