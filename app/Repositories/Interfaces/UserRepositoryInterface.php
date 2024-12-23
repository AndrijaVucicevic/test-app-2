<?php


namespace App\Repositories\Interfaces;

use App\Data\DataTableParamsData;
use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function table(DataTableParamsData $params);
    public function userPermissions(User $user);

}