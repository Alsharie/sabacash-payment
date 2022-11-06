<?php

namespace Alsharie\SabaCashPayment\Responses;


class SabaCashOperationStatusResponse extends SabaCashResponse
{

    /**
     * @return mixed|void
     */
    public function getAmount()
    {
        if (!empty($this->data['amount'])) {
            return $this->data['amount'];
        }

    }

    /**
     * @return mixed|void
     */
    public function getTransactionDate()
    {
        if (!empty($this->data['transactionDate'])) {
            return $this->data['transactionDate'];
        }

    }


    /**
     * @return mixed|void
     */
    public function getTransactionId()
    {
        if (!empty($this->data['transactionId'])) {
            return $this->data['transactionId'];
        }

    }


    /**
     * @return mixed|void
     */
    public function getStatus()
    {
        if (!empty($this->data['statusCode'])) {
            return $this->data['statusCode'];
        }

        return false;
    }

}