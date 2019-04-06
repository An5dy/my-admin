<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * @use      [登录用户详情]
     * @Author   ze
     * @date     2019/4/1 2:06 PM
     * @param Request $request
     * @return self|static
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return (new UserResource($user))->setMessage('用户信息获取成功。');
    }
}
