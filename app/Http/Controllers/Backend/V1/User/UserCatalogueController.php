<?php

namespace App\Http\Controllers\Backend\V1\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Backend\BaseController;
use App\Http\Resources\User\UserCatalogueResource;
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

    public function index(): Response
    {
        return Inertia::render('user/user_catalogue/index');
    }

    public function create(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

    public function edit($id): Response
    {
        $data = new UserCatalogueResource($this->service->findById($id));
        return Inertia::render('user/user_catalogue/save', compact('data'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $response = $this->service->save($request);
        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue.index');
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    { 
        $response = $this->service->save($request, $id);
        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue.index', editRoute: 'user_catalogue.edit');
    }
}
