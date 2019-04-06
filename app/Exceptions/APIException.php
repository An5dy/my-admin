<?php

namespace App\Exceptions;

use Exception;
use App\Helpers\APIResponse;

class APIException extends Exception
{
    use APIResponse;

    public function __construct($message = "", $code = 0)
    {
        $this->setResponseMessage($message);
        $this->setResponseStatus($code);
    }

    /**
     * @use      [错误返回]
     * @Author   ze
     * @date     2019/3/22 5:31 PM
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return $this->respond();
    }
}
