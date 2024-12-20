<?php

namespace App\Repositories;

use App\Data\DataTableParamsData;
use App\DataTables\DataTableParams;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $userModel)
    {
        parent::__construct($userModel);
    }

    public function table(DataTableParamsData $params)
    {
        try {
            $query = $this->model->newQuery();
            $query = $query->where('id', '<>', auth()->user()->id);

            $this->applySearchFilter($query, $params->search['value']);

            $totalRecords = $query->count();

            $filteredRecords = $query->skip($params->start)
                ->take($params->length)
                ->orderBy($this->getColumnName($params->order[0]['column']), $params->order[0]['dir'])
                ->get();

            $data = UserResource::collection($filteredRecords);

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
                $query->where('first_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }
    }

    private function getColumnName($columnIndex)
    {
        $columns = ['first_name', 'last_name', 'email', 'created_at'];
        return $columns[$columnIndex] ?? 'name';
    }
}
