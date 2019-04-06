<?php

namespace App\Models;

use App\Models\Scopes\ScopeNameTrait;
use App\Models\Scopes\ScopeDisplayNameTrait;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use ScopeNameTrait,
        ScopeDisplayNameTrait;
}
