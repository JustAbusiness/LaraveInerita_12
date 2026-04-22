<?php

namespace App\Services\Impl\V1;

use Illuminate\Http\Request;
use App\Traits\HasSpecBuilder;
use App\Traits\HasTransaction;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\BaseServiceInteface;

abstract class BaseService implements BaseServiceInteface
{
    use HasTransaction, HasSpecBuilder;

    protected $repository;
    protected $request;
    protected $modelData;
    protected $model;
    protected $result;
    protected $withRelation;
    protected $afterSave;
    protected $with = [];
    protected $perpage = 20;
    protected $simpleFilter = ['publish'];
    protected $searchFields = ['name'];


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
        $this->setRequest($request);
        $specification = $this->specifications();
        $this->result = $this->repository->pagination($specification);
        dd($this->result);
        return $this->getResult();
    }
}
