<?php

namespace Alsharie\SabaCashPayment;


use Alsharie\SabaCashPayment\Responses\SabaCashConfirmPaymentResponse;
use Alsharie\SabaCashPayment\Responses\SabaCashErrorResponse;
use Alsharie\SabaCashPayment\Responses\SabaCashInitPaymentResponse;
use Alsharie\SabaCashPayment\Responses\SabaCashLoginResponse;
use Alsharie\SabaCashPayment\Responses\SabaCashOperationStatusResponse;

class SabaCash extends SabaCashAttributes
{


    /**
     * login into the gateway to get the token
     * @return SabaCashErrorResponse|SabaCashLoginResponse
     */
    public function login()
    {
        // set `username`, and `token` .
        $this->setAuthAttributes();

        try {
            $response = $this->sendRequest(
                $this->getLoginPath(),
                $this->attributes,
                $this->headers,
            );

            return new SabaCashLoginResponse((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new SabaCashErrorResponse($e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        }
    }

    /**
     * It Is used to allow the merchant to initiate a payment for a specific customer.
     * @return SabaCashInitPaymentResponse|SabaCashErrorResponse
     */
    public function initPayment()
    {
        // set header info
        $this->setAuthorization();

        if (!isset($this->attributes['CurrencyId'])) {
            $this->attributes['CurrencyId'] = 2;//rial Yemeni
        }

        try {
            $response = $this->sendRequest(
                $this->getOnlinePaymentPath(),
                $this->attributes,
                $this->headers,
            );

            return new SabaCashInitPaymentResponse((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new SabaCashErrorResponse($e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        }
    }


    /**
     * It is used to confirm the initPayment request
     * @return SabaCashConfirmPaymentResponse|SabaCashErrorResponse
     */
    public function confirmPayment()
    {
        // set `username`, and `token` .
        $this->setAuthorization();


        try {
            $response = $this->sendRequest(
                $this->getOnlinePaymentPath(),
                $this->attributes,
                $this->headers,
                'PATCH'
            );

            return new SabaCashConfirmPaymentResponse((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new SabaCashErrorResponse($e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        }
    }


    /**
     * It is used to check the state of an operation ( It is useful in cases of time out).
     * @return SabaCashOperationStatusResponse|SabaCashErrorResponse
     */
    public function checkTransactionStatus()
    {
        // set header info
        $this->setAuthorization();

        try {
            $response = $this->sendRequest(
                $this->getCheckTransactionPath(),
                $this->attributes,
                $this->headers,
                'GET'
            );

            return new SabaCashOperationStatusResponse((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new SabaCashErrorResponse($e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        }
    }

}