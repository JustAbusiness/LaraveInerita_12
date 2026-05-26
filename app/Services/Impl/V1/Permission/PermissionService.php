<?php

namespace App\Services\Impl\V1\Permission;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Services\Impl\V1\BaseService;
use App\Repositories\Permission\PermissionRepo;
use App\Services\Interfaces\Permission\PermissionServiceInterface;

class PermissionService extends BaseService implements PermissionServiceInterface
{
    protected $repository;
    protected $perpage;
    protected $with = ['creators'];
    protected $simpleFilter = ['id', 'publish'];
    protected $searchFields = ['name', 'description'];

    public function __construct(PermissionRepo $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    protected function prepareModelData(): static
    {
        $fillable = $this->repository->getFillable();
        $this->modelData = $this->request->only($fillable);
        $this->modelData['user_id'] = Auth::id();
        return $this;
    }

}
