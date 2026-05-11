<?php

namespace App\Http\Controllers\Backend;

use App\Enum\CommonEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

class BaseController extends Controller
{
    protected $service;
    public function __construct(
        $service
    ) {
        $this->service = $service;
    }

    public function handleAction($request, $response, string $redirectRoute = '', ?string $editRoute = ''): JsonResponse
    {
        if ($response) {
            return $this->responseSuccess($response, Lang::get('message.save_success'));
        }
        return $this->responseError(Lang::get('message.save_failed'));
    }

    protected function responseSuccess($data = [], string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function responseError(string $message = 'Error', int $code = 500, $errors = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

}
