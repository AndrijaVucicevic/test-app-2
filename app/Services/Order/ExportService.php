<?php

namespace App\Services\Order;

use App\Excel\Export\OrdersExport;
use App\Filters\OrdersSearchFilter;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class ExportService{

    public function execute(OrdersSearchFilter $filter, OrderRepositoryInterface $orderRepository){

        return Excel::download(new OrdersExport($filter, $orderRepository), 'orders-export.xlsx');
    }

}