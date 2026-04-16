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

    public function create(array $payload = []): Model|null
    {
        return $this->model->create($payload)->fresh();
    }

    public function update(int $id, array $payload = []): Model
    {
        $model = $this->findById($id);
        $model->fill($payload);
        $model->save();
        return $model;
    }

    public function findById(int $id, array $with = [], array $columns = ['*']): Model
    {
        return $this->model->select($columns)->with($with)->findOrFail($id);
    }

    public function paginate(array $columns = ['*'], array $with = [], int $perPage = 15)
    {
        $query = $this->model->select($columns)->with($with);
        return $query->paginate($perPage);
    }
}
