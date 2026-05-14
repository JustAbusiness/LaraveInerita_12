<?php

namespace App\Http\Resources;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{

    public static function ok($data = null, string $message = 'Success', int $httpCode = Response::HTTP_OK ) : JsonResponse 
    {
        return response()->json([
            'status' => true,
            'code' => $httpCode,
            'data' => $data,
            'message' => $message,
            'timestamp' => now()
        ], $httpCode);
    }

    public static function error($errors = null, string $message = 'Failed', int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse 
    {
        return response()->json([
            'status' => false,
            'code' => $httpCode,
            'errors' => $errors,
            'message' => $message,
            'timestamp' => now()
        ], $httpCode);
    }
    
    public static function message(string $message, int $httpCode = Response::HTTP_OK): JsonResponse 
    {
        return response()->json([
            'status' => true,
            'code' => $httpCode,
            'message' => $message,
            'timestamp' => now()
        ], $httpCode);
    }
}
