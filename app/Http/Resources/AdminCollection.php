<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\APIWithResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminCollection extends ResourceCollection
{
    use APIWithResponse;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nickname' => $item->nickname,
                    'username' => $item->username,
                    'created_at' => $item->created_at->toDateTimeString(),
                    'avatar' => $item->avatar,
                    'roles' => $item->roles->map(function ($role) {
                        return [
                            'id' => $role->id,
                            'display_name' => $role->display_name,
                        ];
                    }),
                    'is_super' => $item->is_super,
                ];
            }),
        ];
    }
}
