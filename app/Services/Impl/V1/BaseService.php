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
            ->beforeSave();


        } catch (\Throwable $th) {
             DB::rollBack();
            return false;
        }
    }


}
