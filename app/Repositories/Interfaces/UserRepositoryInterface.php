<?php


namespace App\Repositories\Interfaces;

use App\Data\DataTableParamsData;
use App\Filters\UsersSearchFilter;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function table(DataTableParamsData $params);

}