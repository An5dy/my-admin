<?php

namespace App\Models;

use App\Models\Scopes\ScopeNameTrait;
use App\Models\Scopes\ScopeDisplayNameTrait;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use ScopeNameTrait,
        ScopeDisplayNameTrait;
}
