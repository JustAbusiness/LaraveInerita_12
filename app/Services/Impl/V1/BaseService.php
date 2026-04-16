<?php

namespace App\Services\Impl\V1;

use Illuminate\Http\Request;
use App\Traits\HasTransaction;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\BaseServiceInteface;

abstract class BaseService implements BaseServiceInteface
{
    use HasTransaction;
    protected $repository;
    protected $request;
    protected $modelData;
    protected $model;
    protected $result;
    protected $withRelation;
    protected $afterSave;
    protected $with = [];


    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    protected abstract function prepareModelData(): static;

    protected function setRequest($request): static
    {
        $this->request = $request;
        return $this;
    }
    public function save(Request $request, ?int $id = null)
    {
        try {
            return $this->beginTransaction()
                ->setRequest($request)
                ->prepareModelData()
                ->beforeSave()
                ->saveModel($id)
                ->withRelation()
                ->afterSave()
                ->commit()
                ->getResult();

        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    private function saveModel(?int $id = null): static
    {
        $this->model = $id ? $this->repository->update($id, $this->modelData) : $this->repository->create($this->modelData);
        $this->result = $this->model;
        return $this;
    }

    private function getResult()
    {
        return $this->result;
    }

    public function findById(int $id)
    {
        $this->model = $this->repository->findById($id, $this->with);
        $this->result = $this->model;
        return $this->getResult();
    }

    public function paginate(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $this->result = $this->repository->paginate(['*'], $this->with, $perPage);
        return $this->getResult();
    }
}
