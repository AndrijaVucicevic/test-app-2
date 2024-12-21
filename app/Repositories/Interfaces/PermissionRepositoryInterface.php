<?php


namespace App\Repositories\Interfaces;

use App\Data\DataTableParamsData;

interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function table(DataTableParamsData $params);

}