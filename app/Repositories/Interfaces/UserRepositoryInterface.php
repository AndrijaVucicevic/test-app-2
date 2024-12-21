<?php


namespace App\Repositories\Interfaces;

use App\Data\DataTableParamsData;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function table(DataTableParamsData $params);

}