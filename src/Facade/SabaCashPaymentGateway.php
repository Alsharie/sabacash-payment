<?php

namespace Alsharie\SabaCashPayment\Facade;

use Illuminate\Support\Facades\Facade;
use Alsharie\SabaCashPayment\SabaCash;

class SabaCashPaymentGateway extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     */
    protected static function getFacadeAccessor()
    {
        return SabaCash::class;
    }
}