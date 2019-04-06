<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'private_key' => env('PASSPORT_PRIVATE_KEY'),

    'public_key' => env('PASSPORT_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | token 失效时间
    |--------------------------------------------------------------------------
    */

    'tokens_expire_in' => env('PASSPORT_TOKENS_EXPIRE_IN'),

    'refresh_tokens_expire_in' => env('PASSPORT_REFRESH_TOKENS_EXPIRE_IN'),

    /*
    |--------------------------------------------------------------------------
    | passport 配置文件
    |--------------------------------------------------------------------------
    */

    'client_id' => env('PASSPORT_CLIENT_ID'),

    'client_secret' => env('PASSPORT_CLIENT_SECRET'),

];
