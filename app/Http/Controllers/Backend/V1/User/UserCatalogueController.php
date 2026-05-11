<?php

namespace App\Http\Controllers\Backend\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Backend\BaseController;
use App\Http\Requests\User\Catalogue\StoreRequest;
use App\Http\Requests\User\Catalogue\UpdateRequest;
use App\Services\Interfaces\User\UserCatalogueServiceInterface as UserCatalogueService;

class UserCatalogueController extends BaseController
{
    protected $service;

    public function __construct(
        UserCatalogueService $service
    ) {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $data = $this->service->paginate($request);
        return $this->responseSuccess($data);
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->service->show($id);
        return $this->responseSuccess($data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $response = $this->service->save($request);
        return $this->handleAction($request, $response);
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $response = $this->service->save($request, $id);
        return $this->handleAction($request, $response);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->service->destroy($id);
        return $this->handleAction(request(), $response);
    }
}
