<?php

namespace App\Helpers;
use Illuminate\Http\JsonResponse;
class ApiResponseHelper
{
    public static function apiResponse($status, $code, $message, $data = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
