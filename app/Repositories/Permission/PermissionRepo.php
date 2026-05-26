<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepo;
use App\Models\Permission;

class PermissionRepo extends BaseRepo
{
    public function __construct(Permission $model)
    {
         parent::__construct($model);
    }
}
