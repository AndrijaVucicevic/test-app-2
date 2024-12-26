<?php

namespace App\Repositories;

use App\Data\DataTableParamsData;
use App\Http\Resources\PermissionResource;
use App\Repositories\Interfaces\ImportRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Exception;
use Spatie\Permission\Models\Permission;

class ImportRepository extends BaseRepository implements ImportRepositoryInterface
{
    public function __construct(Permission $permissionModel)
    {
        parent::__construct($permissionModel);
    }

 
}
