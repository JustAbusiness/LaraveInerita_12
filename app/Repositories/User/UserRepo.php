<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepo;
use App\Models\User;

class UserRepo extends BaseRepo
{
    public function __construct(User $model)
    {
         parent::__construct($model);
    }
}






