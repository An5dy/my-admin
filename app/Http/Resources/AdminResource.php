<?php

namespace App\Http\Resources;

use App\Http\Resources\Traits\APIWithResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    use APIWithResponse;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'username' => $this->username,
            'roles' => $this->roles()->pluck('id'),
        ];
    }
}
