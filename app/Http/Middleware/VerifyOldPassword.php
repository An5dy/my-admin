<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\APIException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class VerifyOldPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $oldPassword = $request->old_password;
        $username = $request->username;

        if (Auth::guard('admin')->once(['password' => $oldPassword, 'username' => $username])) {
            return $next($request);
        }

        throw new APIException('原密码不正确。', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
