<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\APIWithResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RolesCollection extends ResourceCollection
{
    use APIWithResponse;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'display_name' => $item->display_name,
                ];
            })
        ];
    }
}
