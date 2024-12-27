<?php

namespace App\Repositories;

use App\Data\DataTableParamsData;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Exception;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function table(DataTableParamsData $params)
    {
        try {
            $query = $this->model->newQuery();

            $this->applySearchFilter($query, $params->search['value']);

            $totalRecords = $query->count();

            $filteredRecords = $query->skip($params->start)
                ->take($params->length)
                ->orderBy($this->getColumnName($params->order[0]['column']), $params->order[0]['dir'])
                ->get();

            $data = OrderResource::collection($filteredRecords);

            return [
                'draw' => $params->draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data,
            ];
        } catch (Exception $e) {
            return [
                'draw' => $params->draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => $e->getMessage(),
            ];
        }
    }

    private function applySearchFilter($query, $searchValue)
    {
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('channel', 'like', '%' . $searchValue . '%')
                    ->orWhere('sku', 'like', '%' . $searchValue . '%');
            });
        }
    }

    private function getColumnName($columnIndex)
    {
        $columns = [
            'order_date',
            'channel',
            'sku',
            'item_description',
            'origin',
            'so_num',
            'cost',
            'shipping_cost',
            'total_price',
            'import_log_id'
        ];
        return $columns[$columnIndex] ?? 'name';
    }
}
