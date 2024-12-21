<?php

namespace App\Repositories;

use App\Data\DataTableParamsData;
use App\Http\Resources\PermissionResource;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Exception;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permissionModel)
    {
        parent::__construct($permissionModel);
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

            $data = PermissionResource::collection($filteredRecords);

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
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('guard_name', 'like', '%' . $searchValue . '%');
            });
        }
    }

    private function getColumnName($columnIndex)
    {
        $columns = ['name', 'guard_name', 'created_at'];
        return $columns[$columnIndex] ?? 'name';
    }
}
