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

    public function getFillable(): array
    {
        return $this->model->getFillable();
    }

    public function getRelationable(): array
    {
        return method_exists($this->model, 'getRelationable') ? $this->model->getRelationable() : [];
    }

    public function create(array $payload)
    {
        return $this->model->create($payload);
    }
}
