<?php

namespace Alsharie\SabaCashPayment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Guzzle
{
    /**
     * Store guzzle client instance.
     *
     * @var SabaCash
     */
    protected $guzzleClient;

    /**
     * SabaCash payment base path.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Store SabaCash payment endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * BaseService Constructor.
     */
    public function __construct()
    {
        $this->guzzleClient = new Client();
        $this->basePath = config('sabaCash.url.base');
    }


    /**
     * @param $path
     * @param $attributes
     * @param string $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function sendRequest($path, $attributes, $headers,  $security = [], string $method = 'POST'): ResponseInterface
    {
        return $this->guzzleClient->request(
            $method,
            $path,
            [
                'headers' => array_merge(
                    [
                        'Content-Type' => 'application/json',
                    ],
                    $headers
                ),
                'json' => $attributes,
                ...$security
            ]
        );
    }


    protected function getLoginPath(): string
    {
        return $this->basePath . '/' . "api/user-ms/v1/login";
    }

    protected function getChangePasswordPath(): string
    {
        return $this->basePath . '/' . "api/user-ms/v1/user/changeUserPassword";
    }

    protected function getOnlinePaymentPath(): string
    {
        return $this->basePath . '/' . "api/accounts/v1/adjustment/onLinePayment";
    }

    protected function getCheckTransactionPath(): string
    {
        return $this->basePath . '/' . "api/accounts/v1/adjustment/checkAdjustmentByTransactionId";
    }


}