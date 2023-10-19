<?php
declare(strict_types=1);

namespace CanisLupus\ApiClients\PagSeguro\v1;

use CanisLupus\ApiClients\PagSeguro\v1\Enums\EnvironmentEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Enums\MethodEnum;
use CanisLupus\ApiClients\PagSeguro\v1\Exceptions\PagSeguroApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class PagSeguroApiHandler
{
    protected PagSeguroApiConfig $config;
    protected string $baseEndpoint;


    /**
     * @param PagSeguroApiConfig $config
     */
    public function __construct(
        PagSeguroApiConfig $config
    )
    {
        $this->config = $config;

        switch ($config->getEnvironment()) {
            default:
            case EnvironmentEnum::Production:
                $this->baseEndpoint = 'https://api.pagseguro.com/';
                break;

            case EnvironmentEnum::Sandbox:
                $this->baseEndpoint = 'https://sandbox.api.pagseguro.com/';
                break;
        }
    }


    /**
     * @param MethodEnum $method
     * @param string $endpoint
     * @param array|null $params
     *
     * @return array
     * @throws PagSeguroApiException
     */
    protected function call(MethodEnum $method, string $endpoint, array $params = null, array $headers = null): array
    {
        $endpoint = $this->baseEndpoint . $endpoint;

        try {
            $guzzleClient = new Client();

            $headers = $headers ?? [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ];


            if ($this->config->getToken()) {
                $headers['Authorization'] = 'Bearer ' . $this->config->getToken();
            }

            $res = $guzzleClient->request($method->value, $endpoint, [
                RequestOptions::JSON => $params,
                RequestOptions::HEADERS => $headers
            ]);

            $result = json_decode((string)$res->getBody(), true);

            if (!$result) {
                return [];
            }

            return $result;

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorData = json_decode((string)$e->getResponse()->getBody(), true);

                $message = '';
                if (isset($errorData['error_messages'])) {
                    foreach ($errorData['error_messages'] as $errorMessage) {
                        $message .= 'Error CODE: ' . ($errorMessage['code'] ?? 'N/A');
                        $message .= ' DESCRIPTION: ' . ($errorMessage['description'] ?? 'N/A');
                        $message .= ' PARAMETER_NAME: ' . ($errorMessage['parameter_name'] ?? 'N/A');
                        $message .= ' | ';
                    }
                    $message = substr($message, 0, strlen($message)-3);
                } else {
                    if ($e->getMessage()) {
                        $message = $e->getMessage();
                    }else{
                        $message = 'The API returned no message, maybe an Authentication failure';
                    }
                }

                throw (new PagSeguroApiException($message));

            } else if ($e->getMessage()) {
                throw (new PagSeguroApiException($e->getMessage()));

            } else {
                $response = $e->getHandlerContext();

                if (isset($response['error'])) {
                    throw new PagSeguroApiException($response['error']);
                } else {
                    throw new PagSeguroApiException("An unknow error ocurred calling: $endpoint with method: $method->value");
                }
            }

        } catch (GuzzleException $e) {
            throw new PagSeguroApiException($e->getMessage());
        }
    }
}
