<?php

namespace Alsharie\SabaCashPayment;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Utils;
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
        if (!isset($_SESSION)) {
            session_start();
        }
        $stack = new HandlerStack();
        $stack->setHandler(Utils::chooseHandler());
        $stack->push(\GuzzleHttp\Middleware::retry(
            function (
                $retries,
                \GuzzleHttp\Psr7\Request $request,
                \GuzzleHttp\Psr7\Response $response = null,
                $exception = null
            ) {
                $maxRetries = 5;

                if ($retries >= $maxRetries) {
                    return false;
                }

                if ($response && ($response->getStatusCode() === 401 || $response->getStatusCode() === 400)) {
                    // received 401, so we need to refresh the token
                    $saba_cash = new SabaCash();
                    $saba_cash->login();
                    return true;
                }


                return false;
            }
        ));


        $this->guzzleClient = new Client([
            'handler' => $stack,
        ]);

        $this->basePath = config('sabaCash.url.base');
    }


    /**
     * @param $path
     * @param $attributes
     * @param string $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function sendRequest($path, $attributes, $headers, $security = [], string $method = 'POST'): ResponseInterface
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