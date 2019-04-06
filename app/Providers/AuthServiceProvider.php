<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\RouteRegistrar;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(Carbon::now()->addHours(config('passport.tokens_expire_in')));

        Passport::refreshTokensExpireIn(Carbon::now()->addHours(config('passport.refresh_tokens_expire_in')));

        Passport::routes(function (RouteRegistrar $router) {
            $router->forAccessTokens();
        }, [
            'prefix' => 'api/oauth',
        ]);
    }
}
