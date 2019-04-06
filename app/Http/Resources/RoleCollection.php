<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\APIWithResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
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
                    'name' => $item->name,
                    'display_name' => $item->display_name,
                    'created_at' => $item->created_at->toDateTimeString(),
                    'permissions' => $item->permissions->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'display_name' => $item->display_name,
                        ];
                    }),
                ];
            }),
        ];
    }
}
