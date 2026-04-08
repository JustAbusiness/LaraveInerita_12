<?php

namespace App\Http\Controllers\Backend\V1\User;

use App\Enum\CommonEnum;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\RedirectResponse;
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

    public function index(): Response
    {
        return Inertia::render('user/user_catalogue/index');
    }

    public function create(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

    public function edit(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $context = ['action' => 'store'];
        $response = $this->service->save($request, $context);
        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue/index');
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $context = ['action' => 'update', 'id' => $id];
        $response = $this->service->save( $request, $context);
        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue/index');
    }
}
