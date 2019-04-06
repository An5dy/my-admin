<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Proxies\Passport\PasswordProxy;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers,
        APIResponse;

    protected $passwordProxy;

    public function __construct(PasswordProxy $passwordProxy)
    {
        $this->passwordProxy = $passwordProxy;
    }

    /**
     * @use      [登陆用户名]
     * @Author   ze
     * @date     2019/3/21 11:00 PM
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * @use      [设置看守器]
     * @Author   ze
     * @date     2019/3/21 10:59 PM
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * @use      [验证账号]
     * @Author   ze
     * @date     2019/3/21 10:59 PM
     * @param Request $request
     * @return mixed
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->once(
            $this->credentials($request)
        );
    }

    /**
     * @use      [登录成功返回]
     * @Author   ze
     * @date     2019/3/22 3:25 PM
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        try {
            $tokens = $this->passwordProxy
                ->tokens($this->credentials($request));

            $cookie = cookie(
                'refresh_token',
                $tokens->refresh_token,
                config('passport.refresh_tokens_expire_in') * 60);

            return $this->setResponseData([
                'token_type' => $tokens->token_type,
                'expires_in' => $tokens->expires_in,
                'access_token' => $tokens->access_token,
            ])
                ->succeedResponse('登录成功。')
                ->withCookie($cookie);
        } catch (\Exception $exception) {

            return $this->failedResponse('登录失败。');
        }
    }

    /**
     * @use      [登录失败]
     * @Author   ze
     * @date     2019/3/22 3:30 PM
     * @param Request $request
     * @return JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return $this->setResponseStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->setResponseMessage(trans('auth.failed'))
            ->respond();
    }

    /**
     * @use      [登录失败锁定]
     * @Author   ze
     * @date     2019/3/22 3:34 PM
     * @param Request $request
     * @return JsonResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return $this->setResponseStatus(JsonResponse::HTTP_TOO_MANY_REQUESTS)
            ->setResponseMessage(Lang::get('auth.throttle', ['seconds' => $seconds]))
            ->respond();
    }

    /**
     * @use      [退出登录]
     * @Author   ze
     * @date     2019/3/22 4:39 PM
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        DB::beginTransaction();
        try {
            $accessToken = Auth::guard('api')->user()->token();

            // 移除 refresh token
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->delete();

            $accessToken->delete();
            DB::commit();

            $cookie = cookie('refresh_token', '', -10086);

            return $this->succeedResponse('退出成功。')->withCookie($cookie);
        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->failedResponse('退出失败。');
        }
    }

    /**
     * @use      [刷新 token]
     * @Author   ze
     * @date     2019/3/31 11:23 PM
     * @return $this|JsonResponse
     */
    public function refresh()
    {
        try {
            $tokens = $this->passwordProxy
                ->refresh(request()->cookie('refresh_token'));

            $cookie = cookie(
                'refresh_token',
                $tokens->refresh_token,
                config('passport.refresh_tokens_expire_in') * 60);

            return $this->setResponseData([
                'token_type' => $tokens->token_type,
                'expires_in' => $tokens->expires_in,
                'access_token' => $tokens->access_token,
            ])
                ->succeedResponse('登录成功。')
                ->withCookie($cookie);
        } catch (\Exception $exception) {
            return $this->failedResponse('登录失败。');
        }
    }
}
