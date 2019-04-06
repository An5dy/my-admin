<?php

namespace App\Http\Resources\Traits;

use App\Helpers\ResponseMessage;
use Illuminate\Http\JsonResponse;

trait APIWithResponse
{
    protected $message;

    /**
     * @use      [设置 message]
     * @Author   ze
     * @date     2019/3/24 10:54 PM
     * @param string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @use      [获取 message]
     * @Author   ze
     * @date     2019/3/24 10:49 PM
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message ?? ResponseMessage::HTTP_OK;
    }

    /**
     * @use      [返回额外数据]
     * @Author   ze
     * @date     2019/3/24 10:43 PM
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'code' => JsonResponse::HTTP_OK,
            'message' => $this->getMessage(),
        ];
    }
}