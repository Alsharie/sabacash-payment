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
     * @param $terminal
     * @return SabaCashAttributes
     */
    public function setBeneficiaryTerminal($terminal): SabaCashAttributes
    {
        if (isset($this->attributes['beneficiary'])) {
            $this->attributes['beneficiary']['terminal'] = $terminal;
        } else {
            $this->attributes['beneficiary'] = [
                'terminal' => $terminal
            ];
        }
        return $this;
    }


    /**
     * @param $phone
     * @return SabaCashAttributes
     */
    public function setBeneficiaryCode($phone): SabaCashAttributes
    {
        if (isset($this->attributes['beneficiary'])) {
            $this->attributes['beneficiary']['code'] = $phone;
        } else {
            $this->attributes['beneficiary'] = [
                'code' => $phone
            ];
        }
        return $this;
    }


    /**
     * set customer phone (source code)
     * @param $phone
     * @return SabaCashAttributes
     */
    public function setSourceCode($phone): SabaCashAttributes
    {
        if (isset($this->attributes['source'])) {
            $this->attributes['source']['code'] = $phone;
        } else {
            $this->attributes['source'] = [
                'code' => $phone
            ];
        }
        return $this;
    }


    /**
     * @param $id
     * @return SabaCashAttributes
     */
    public function setAdjustmentId($id): SabaCashAttributes
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    /**
     * @param $transactionId
     * @return SabaCashAttributes
     */
    public function setTransactionId($transactionId): SabaCashAttributes
    {
        $this->attributes['transactionId'] = $transactionId;
        return $this;
    }


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
     * set currencyId in source & beneficiary & amountCurrencyId
     * 2 = rial Yemeni
     * @param int $CurrencyId
     * @return SabaCashAttributes
     */
    public function setCurrency(int $CurrencyId = 2): SabaCashAttributes
    {
        $this->attributes['amountCurrencyId'] = $CurrencyId;
        if (isset($this->attributes['beneficiary'])) {
            $this->attributes['beneficiary']['currencyId'] = $CurrencyId;
        } else {
            $this->attributes['beneficiary'] = [
                'currencyId' => $CurrencyId
            ];
        }
        if (isset($this->attributes['source'])) {
            $this->attributes['source']['currencyId'] = $CurrencyId;
        } else {
            $this->attributes['source'] = [
                'currencyId' => $CurrencyId
            ];
        }
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
        $this->attributes['otp'] = $otp;
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