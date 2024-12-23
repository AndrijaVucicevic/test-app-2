<?php

namespace App\Repositories;

use App\Data\DataTableParamsData;
use App\DataTables\DataTableParams;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

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

    public function userPermissions(User $user)
    {
        $search = request('search', '');
        $page = request('page', 1);
        $perPage = 10;

        $query = Permission::select(
            'permissions.id',
            'permissions.name as text',
            DB::raw("CASE WHEN model_has_permissions.permission_id IS NOT NULL THEN true ELSE false END AS selected")
        )
            ->leftJoin('model_has_permissions', function ($join) use ($user) {
                $join->on('permissions.id', '=', 'model_has_permissions.permission_id')
                    ->where('model_has_permissions.model_id', '=', $user->id)
                    ->where('model_has_permissions.model_type', '=', get_class($user));
            })
            ->whereNull('model_has_permissions.permission_id')
            ->when($search, function ($query, $search) {
                $query->where('permissions.name', 'like', '%' . $search . '%');
            });

        $total = $query->count();
        $permissions = $query
            ->orderBy('selected', 'desc')
            ->orderBy('permissions.name', 'asc')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        // Priprema podataka za Select2
        $response = [
            'results' => $permissions,
            'count_filtered' => $total,
        ];

        return $response;
    }
}
