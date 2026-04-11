<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepo
{
    protected $model;
    protected $payload;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getFillable():  array
    {
        return $this->model->getFillable();
    }

    public function getRelationable():  array
    {
        return $this->model->getRelationable();
    }

    public function create(array $payload = []);
}
