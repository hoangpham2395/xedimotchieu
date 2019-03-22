<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID', '330781920904654'),
        'client_secret' => env('FACEBOOK_APP_SECRET', 'ced14e28496b0396f1fa6d3fcfd63176'),
        'redirect' => env('FACEBOOK_APP_CALLBACK_URL', 'https://dev.xemotchieu.vn/callback/facebook'),
    ],
    'github' => [
        'client_id' => env('GITHUB_APP_ID'),
        'client_secret' => env('GITHUB_APP_SECRET'),
        'redirect' => env('GITHUB_APP_CALLBACK_URL'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_APP_ID'),
        'client_secret' => env('TWITTER_APP_SECRET'),
        'redirect' => env('TWITTER_APP_CALLBACK_URL'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_APP_ID'),
        'client_secret' => env('GOOGLE_APP_SECRET'),
        'redirect' => env('GOOGLE_APP_CALLBACK_URL'),
    ],
];
