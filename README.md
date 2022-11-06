# SabaCash-payment [beta]
![img.svg](img.svg)

laravel package for SabaCash payment getway
install the package
`composer require alsharie/sabacash-payment`

You can publish using the following command

`php artisan vendor:publish --provider="Alsharie\SabaCashPayment\SabaCashServiceProvider"`

When published, the `config/sabaCash.php` config file contains:

```php
return [
    'auth' => [
        'username' => env('SABACASH_MERCHANT_USERNAME'),
        'password' => env('SABACASH_MERCHANT_PASSWORD'),
        'token' => env('SABACASH_MERCHANT_TOKEN'),
    ],
    'url' => [
        'base' => env('SABACASH_BASE_URL', 'https://api.sabacash.ye:49901'),
    ]
];
```

you can get the full **response body** using `$response->body()` for all requests