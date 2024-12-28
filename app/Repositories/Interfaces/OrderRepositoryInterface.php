<?php


namespace App\Repositories\Interfaces;

use App\Data\DataTableParamsData;
use App\Filters\OrdersSearchFilter;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function table(OrdersSearchFilter $filter);

}