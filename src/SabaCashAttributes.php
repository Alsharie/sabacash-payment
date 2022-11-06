<?php

namespace Alsharie\SabaCashPayment;


class SabaCashAttributes extends Guzzle
{

    /**
     * Store request attributes.
     */
    protected array $attributes = [];

    protected array $headers = [];
    protected array $temp = [];





    /**
     * @param $amount
     * @return SabaCashAttributes
     */
    public function setAmount($amount): SabaCashAttributes
    {
        $this->attributes['amount'] = $amount;
        return $this;
    }


    /**
     * Cash team will provide u upon request
     * 2= Rial Yemeni
     * 4= Dollar
     * 5= Rial Saudi
     * @param $CurrencyId
     * @return SabaCashAttributes
     */
    public function setCurrency($CurrencyId): SabaCashAttributes
    {
        $this->attributes['amountCurrencyId'] = $CurrencyId;
        return $this;
    }


    /**
     * @param $note
     * @return SabaCashAttributes
     */
    public function setNote($note): SabaCashAttributes
    {
        $this->attributes['note'] = $note;
        return $this;
    }


    /**
     * Transaction Code returned in InitPayment response
     * @param $refId
     * @return SabaCashAttributes
     */
    public function setTransactionRef($refId): SabaCashAttributes
    {
        $this->attributes['TransactionRef'] = $refId;
        return $this;
    }


    /**
     * it’s 6 digit and unique we sent it to customer phone via SMS
     * when you use purchase request API.
     * @param $otp
     * @return SabaCashAttributes
     */
    public function setOtp($otp): SabaCashAttributes
    {
        $this->temp['otp'] = $otp;
        return $this;
    }


    /**
     * @param array $attributes
     * @return SabaCashAttributes
     */
    public function setAttributes(array $attributes): SabaCashAttributes
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return SabaCashAttributes
     */
    public function mergeAttributes(array $attributes): SabaCashAttributes
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return SabaCashAttributes
     */
    public function setAttribute($key, $value): SabaCashAttributes
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param mixed $key
     *
     * @return boolean
     */
    public function hasAttribute($key): bool
    {
        return isset($this->attributes[$key]);
    }

    /**
     * @param mixed $key
     *
     * @return SabaCashAttributes
     */
    public function removeAttribute($key): SabaCashAttributes
    {
        $this->attributes = array_filter($this->attributes, function ($name) use ($key) {
            return $name !== $key;
        }, ARRAY_FILTER_USE_KEY);

        return $this;
    }


    /**
     * @return void
     */
    protected function setAuthAttributes()
    {
        $this->attributes['username'] = config('sabaCash.auth.username');
        $this->attributes['password'] = config('sabaCash.auth.password');
    }


    /**
     * @return void
     */
    protected function setAuthorization()
    {
        $this->headers['Authorization'] = 'bearer ' . config('sabaCash.auth.token');
    }



}