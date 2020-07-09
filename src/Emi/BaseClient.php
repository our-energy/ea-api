<?php

declare(strict_types=1);

namespace OurEnergy\Emi;

use Nyholm\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    const BASE_URL = 'https://emi.azure-api.net/';

    /** @var string */
    protected $subscriptionKey;

    /** @var ClientInterface */
    protected $httpClient;

    /** @var ResponseInterface */
    protected $response;

    /**
     * BaseClient constructor.
     *
     * @param string $subscriptionKey
     * @param ClientInterface $httpClient
     */
    public function __construct(string $subscriptionKey, ClientInterface $httpClient)
    {
        $this->subscriptionKey = $subscriptionKey;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param string|null $body
     *
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    protected function request(string $method, string $uri, string $body = null): ResponseInterface
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
        ];

        $request = new Request($method, self::BASE_URL . $uri, $headers, $body);

        $this->response = $this->httpClient->sendRequest($request);

        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    protected function parseBody(ResponseInterface $response): array
    {
        $json = (string)$response->getBody();

        return json_decode($json, true, 512, JSON_OBJECT_AS_ARRAY);
    }

    /**
     * @param array $parameters
     *
     * @return string
     */
    protected function buildQuery(array $parameters): string
    {
        // Remove empty parameters
        $parameters = array_filter($parameters, function ($parameter) {
            return !is_null($parameter);
        });

        return http_build_query($parameters);
    }

    /**
     * @return string
     */
    public function getSubscriptionKey(): string
    {
        return $this->subscriptionKey;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
