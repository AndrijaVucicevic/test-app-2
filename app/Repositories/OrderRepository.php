<?php

namespace App\Repositories;

use App\Data\DataTableParamsData;
use App\Filters\OrdersSearchFilter;
use App\Http\Resources\OrderResource;
use App\Models\ImportLog;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Exception;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function table(OrdersSearchFilter $filter)
    {
        $query = $this->model->newQuery()
            ->select('orders.*');
        if ($filter->filterSearch != '') {
            $this->applySearchFilter($query, $filter->filterSearch);
        }

        if (request()->has('mainKey')) {
            $query = $query->whereIn('import_log_id', $this->getImportLogsFromKey(request()->get('mainKey')));
        }
        return $query->orderBy('id', 'desc');
    }

    private function applySearchFilter($query, $searchValue)
    {
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('order_date', 'like', '%' . $searchValue . '%')
                    ->orWhere('channel', 'like', '%' . $searchValue . '%')
                    ->orWhere('sku', 'like', '%' . $searchValue . '%')
                    ->orWhere('item_description', 'like', '%' . $searchValue . '%')
                    ->orWhere('origin', 'like', '%' . $searchValue . '%')
                    ->orWhere('so_num', 'like', '%' . $searchValue . '%')
                    ->orWhere('cost', 'like', '%' . $searchValue . '%')
                    ->orWhere('shipping_cost', 'like', '%' . $searchValue . '%')
                    ->orWhere('total_price', 'like', '%' . $searchValue . '%');
            });
        }
    }

    private function getImportLogsFromKey(string $key): array
    {
        return ImportLog::where('import_type', $key)->get()->pluck('id')->toArray();
    }
}
