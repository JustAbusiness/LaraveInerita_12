<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepo;
use App\Models\UserCatalogue;

class UserCatalogueRepo extends BaseRepo
{
    public function __construct(UserCatalogue $model)
    {
         parent::__construct($model);
    }
}






