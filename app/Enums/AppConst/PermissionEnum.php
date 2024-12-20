<?php


namespace App\Enums\AppConst;


enum PermissionEnum: string
{
    case UsersList = 'users.list';
    case UsersCreate = 'users.create';
    case UsersUpdate = 'users.update';
    case UsersShow = 'users.show';
    case UsersDelete = 'users.delete';

    case PermissionsList = 'permissions.list';
    case PermissionsCreate = 'permissions.create';
    case PermissionsUpdate = 'permissions.update';
    case PermissionsShow = 'permissions.show';
    case PermissionsDelete = 'permissions.delete';

    case ImportsList = 'imports.list';
    case ImportsCreate = 'imports.create';
    case ImportsUpdate = 'imports.update';
    case ImportsShow = 'imports.show';
    case ImportsDelete = 'imports.delete';

    case UserManagement = 'user_management';
}
