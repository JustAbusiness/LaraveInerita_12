<?php

namespace App\Http\Controllers\Backend\V1\User;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Backend\BaseController;

class UserCatalogueController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): Response
    {
        return Inertia::render('user/user_catalogue/index');
    }

    public function create(): Response
    {
        return Inertia::render('user/user_catalogue/save');
    }

}
