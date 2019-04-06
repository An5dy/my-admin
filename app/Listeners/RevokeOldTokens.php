<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Passport\Events\AccessTokenCreated;

class RevokeOldTokens
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @use      [删除旧的 access token]
     * @Author   ze
     * @date     2019/3/22 1:32 PM
     * @param AccessTokenCreated $event
     */
    public function handle(AccessTokenCreated $event)
    {
        DB::table('oauth_access_tokens')
            ->where('id', '!=', $event->tokenId)
            ->where('user_id', $event->userId)
            ->where('client_id', $event->clientId)
            ->delete();
    }
}
