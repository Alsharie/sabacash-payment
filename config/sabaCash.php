<?php

return [
    'auth' => [
        'username' => env('SABACASH_MERCHANT_USERNAME'),
        'password' => env('SABACASH_MERCHANT_PASSWORD'),
    ],
    'url' => [
        'base' => env('SABACASH_BASE_URL', 'https://api.sabacash.ye:49901'),
    ]
];
