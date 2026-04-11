<?php

namespace App\Services\Impl\V1\User;

use Illuminate\Support\Str;
use App\Services\Impl\V1\BaseService;
use App\Repositories\User\UserCatalogueRepo;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\User\UserCatalogueServiceInterface;

class UserCatalogueService extends BaseService implements UserCatalogueServiceInterface
{
     protected $repository;


    public function __construct(UserCatalogueRepo $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    protected function prepareModelData(): static {
         $fillable = $this->repository->getFillable();
         $this->modelData = $this->request->only($fillable);
         $this->modelData['canonical'] = Str::slug($this->modelData['canonical']);
         $this->modelData['user_id'] = Auth::id();
         dd($this->modelData);
         return $this;
     }

}



