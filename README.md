# SabaCash-payment

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

To purchase using SabaCash payment

### 1. Purchase

```php
    $sabaCash = new SabaCash();
    $response = $sabaCash
        ->setCurrency(2)
        ->setNote('this is simple note')
        ->setAmount(3000)
        ->setBeneficiaryTerminal(1)
        ->setSourceCode(/*phone number*/)
        ->initPayment();

    if ($response->isSuccess()) {
        $response->getAdjustment();
        ... 
        ...
    } 
       
```

### 2. Confirm purchase

```php
    $sabaCash = new SabaCash();
    $response = $sabaCash
        ->setAdjustmentId(603414)
        ->setOtp(5761)
        ->setOperationApprove()
        ->setNote('تاكيد عملية الدفع')
        ->confirmPayment();
    if ($response->isSuccess()) {
        return $response->getTransactionId();
    }
```

### 3. Check Transaction Status

```php
    $sabaCash = new SabaCash();
    $response = $sabaCash
        ->setTransactionId(/*tranId*/)
        ->checkTransactionStatus();

    if ($response->isSuccess()) {
        return $response->getStatus();
    }
```

you can get the full **response body** using `$response->body()` for all requests