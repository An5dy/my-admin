<?php

namespace App\Models\Scopes;

trait ScopeNameTrait
{
    /**
     * @use      [名称作用域]
     * @Author   ze
     * @date     2019/3/26 5:16 PM
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeName($query, $name)
    {
        return isset($name) ? $query->where('name', 'like', '%'.$name.'%') : $query;
    }
}