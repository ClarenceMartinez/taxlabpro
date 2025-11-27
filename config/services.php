<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'irs_a2a' => [

        'client_id' => env('IRS_API_CLIENT_ID'),
        'user_id'   => env('IRS_USER_ID'),
        'your_transmitter_tcc' => env('IRS_TCC'),
        'private_key_path' => env('IRS_PRIVATE_KEY_PATH'),
        'private_key_id'   => env('IRS_PRIVATE_KEY_ID'),
        'token_url' => env('IRS_TOKEN_URL'),
        'api_base_url' => env('IRS_API_BASE_URL'),
        'audience' => env('IRS_TOKEN_URL'),
        'token_cache_key' => 'irs_a2a_access_token',
        'token_cache_ttl_safety_margin' => 60,


        'client_id_test' => env('IRS_API_CLIENT_ID_TEST'),
        'user_id_test'   => env('IRS_USER_ID_TEST'),
        'private_key_path_test' => env('IRS_PRIVATE_KEY_PATH_TEST'),
        'private_key_id_test'   => env('IRS_PRIVATE_KEY_ID_TEST'),
        'token_url_test' => env('IRS_TOKEN_URL_TEST'),
        'api_base_url_test' => env('IRS_API_BASE_URL_TEST'),
        'your_transmitter_tcc_test' => env('IRS_TCC_TEST'),
        // This is missing in production because of manual upload
    ],
];
