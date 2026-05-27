<?php

namespace App\Repositories\Post;

use App\Repositories\BaseRepo;
use App\Models\Post;

class PostRepo extends BaseRepo
{
    public function __construct(Post $model)
    {
         parent::__construct($model);
    }
}
