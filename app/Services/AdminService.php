<?php

namespace App\Services;

use App\Models\Admin;

class AdminService
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function findAdminById(int $id, array $columns = ['*'])
    {
        return $this->admin->findOrFail($id, $columns);
    }
}