<?php

namespace App\Http\Controllers;

use \Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function sendResponse($result, $message =null, $status = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'result' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }


    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'error' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
