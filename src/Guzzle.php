<?php

namespace Alsharie\SabaCashPayment;

use Alsharie\SabaCashPayment\Helpers\SabaCashAuthHelper;
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

        $this->guzzleClient = new Client();

        $this->basePath = config('sabaCash.url.base');
    }


    /**
     * @param $path
     * @param $attributes
     * @param $headers
     * @param array $security
     * @param string $method
     * @return ResponseInterface
     */
    protected function sendRequest($path, $attributes, $headers, $security = [], string $method = 'POST'): ResponseInterface
    {
        $retries = 0;
        $success = false;
        $_response = null;
        do {
            $headers['Authorization'] = 'Bearer ' . SabaCashAuthHelper::getAuthToken();
            try {
                $_response = $this->guzzleClient->request(
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
              
                if ($_response->getStatusCode() == 200) {
                    $retries = 5;
                } else if ($path !== $this->getLoginPath() &&
                    ($_response && ($_response->getStatusCode() === 401 || $_response->getStatusCode() === 400))) {
                    // received 401, so we need to refresh the token
                    var_export('refresh token');
                    $saba_cash = new SabaCash();
                    $saba_cash->login();
                    $retries++;
                }
            } catch (GuzzleException $e) {
                $retries++;
            }
        } while ($retries <= 2);

        return $_response;
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