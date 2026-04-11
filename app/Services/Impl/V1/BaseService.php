<?php

namespace App\Services\Impl\V1;

use App\Services\Interfaces\BaseServiceInteface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\HasTransaction;

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


    public function __construct($repository)
    {
         $this->repository = $repository;
    }

    protected abstract function prepareModelData(): static;

    public function setRequest($request): static
    {
        $this->request = $request;
        return $this;
    }
    public function save(Request $request, ?int $id  = null) {
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

    private function saveModel(?int $id = null) : static {
        $this->model = $id ?  $this->repository->update($this->modelData, $id) : $this->repository->create($this->modelData);
        $this->result = $this->model;
        return $this;
    }

    private function getResult() {
        $this->result = $this->model;
        return $this;
    }
}
