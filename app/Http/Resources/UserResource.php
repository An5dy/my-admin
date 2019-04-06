<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\APIWithResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use APIWithResponse;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'permissions' => $this->getAllPermissions()->pluck('name'),
        ];
    }
}
