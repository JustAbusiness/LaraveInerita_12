<?php

namespace App\Services\Impl\V1\User;

use App\Services\Impl\V1\BaseService;
use App\Repositories\User\UserCatalogueRepo;
use App\Services\Interfaces\User\UserCatalogueServiceInterface;


class UserCatalogueService extends BaseService implements UserCatalogueServiceInterface
{
    public function __construct(UserCatalogueRepo $repo)
    {
    }
}



