<?php

namespace Alsharie\SabaCashPayment\Responses;


class SabaCashConfirmPaymentResponse extends SabaCashResponse
{

    /**
     * @return boolean
     */
    public function isComplete()
    {
        if (!empty($this->data['completed'])) {
            return $this->data['completed'];
        }

        return false;
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
    public function getAdjustmentId()
    {
        if (!empty($this->data['id'])) {
            return $this->data['id'];
        }

    }


}