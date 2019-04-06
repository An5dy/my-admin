<?php

namespace App\Models\Scopes;

trait ScopeDisplayNameTrait
{
    public function scopeDisplayName($query, $displayName)
    {
        return isset($displayName) ? $query->where('display_name', 'like', '%' . $displayName . '%') : $displayName;
    }
}