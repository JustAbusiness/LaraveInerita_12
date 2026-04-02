<?php

namespace App\Repositories;

class BaseRepo
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    } 

}
