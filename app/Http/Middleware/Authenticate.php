<?php

namespace App\Http\Middleware;

use App\Exceptions\APIException;
use App\Helpers\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * @use      [重写用户认证]
     * @Author   ze
     * @date     2019/3/22 5:10 PM
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @throws APIException
     * @throws AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        if (! $request->expectsJson()) {
            throw new AuthenticationException(
                'Unauthenticated.', $guards, $this->redirectTo($request)
            );
        } else {
            throw new APIException(
                ResponseMessage::HTTP_UNAUTHORIZED,
                JsonResponse::HTTP_UNAUTHORIZED);
        }
    }
}
