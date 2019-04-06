<?php

namespace App\Helpers;

class ResponseMessage
{
    const HTTP_OK = '操作成功。';

    const HTTP_INTERNAL_SERVER_ERROR = '服务器出错了。';

    const HTTP_UNAUTHORIZED = '登录失败或超时。';

    const HTTP_NOT_FOUND = '查询资源不存在。';

    const HTTP_FORBIDDEN = '当前用户没有访问权限。';
}