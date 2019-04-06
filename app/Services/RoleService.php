<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function findRoleById($id)
    {
        return $this->role->findById($id);
    }
}