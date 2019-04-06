<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function findPermissionById($id)
    {
        return $this->permission->findById($id);
    }
}