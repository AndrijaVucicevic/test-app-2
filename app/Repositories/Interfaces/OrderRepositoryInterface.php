<?php


namespace App\Repositories\Interfaces;

use App\Data\DataTableParamsData;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function table(DataTableParamsData $params);

}