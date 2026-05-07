<?php

namespace App\Http\Controllers\Backend\V1\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\BaseController;
use App\Http\Resources\User\UserCatalogueResource;
use App\Http\Requests\User\Catalogue\StoreRequest;
use App\Http\Requests\User\Catalogue\UpdateRequest;
use App\Services\Interfaces\User\UserCatalogueServiceInterface as UserCatalogueService;
use App\Services\Interfaces\User\UserServiceInterface as UserService;

class UserCatalogueController extends BaseController
{
    protected $service;
    protected $userService;

    public function __construct(
        UserCatalogueService $service,
        UserService $userService
    ) {
        $this->service = $service;
        $this->userService = $userService;
    }

    public function index(Request $request): Response
    {
        $data = $this->service->paginate($request);
        $users = $this->userService->paginate((new Request())->merge(['type' => 'all', 'sort' => 'id|desc']));
        return Inertia::render('user/user_catalogue/index', [
            'data' => $data,
            'users' => $users
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

    public function edit(int $id): Response
    {
        $data = new UserCatalogueResource($this->service->findById($id));
        return Inertia::render('user/user_catalogue/save', compact('data'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $response = $this->service->save($request);
        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue.index');
    }

    public function update(UpdateRequest $request, int $id): RedirectResponse
    {
        $response = $this->service->save($request, $id);
        return $this->handleAction($request, $response, redirectRoute: 'user_catalogue.index', editRoute: 'user_catalogue.edit');
    }
}
