<?php

return [
    'auth' => [
        'username' => env('SABACASH_MERCHANT_USERNAME'),
        'password' => env('SABACASH_MERCHANT_PASSWORD'),
        'token' => env('SABACASH_MERCHANT_TOKEN'),
    ],
    'url' => [
        'base' => env('SABACASH_BASE_URL', 'https://www.tamkeen.com.ye:33291'),
    ]
];
