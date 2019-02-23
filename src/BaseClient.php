<?php

namespace EMI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use EMI\Exceptions\InvalidResponse;

abstract class BaseClient
{
    const BASE_URL = 'https://emi.azure-api.net';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $subscriptionKey;

    /**
     * @param string $subscriptionKey
     * @param HandlerStack $handler
     */
    public function __construct(string $subscriptionKey, HandlerStack $handler = null)
    {
        $this->subscriptionKey = $subscriptionKey;

        $options = [];

        if ($handler) {
            $options['handler'] = $handler;
        }

        $this->client = new Client($options);
    }

    /**
     * @param string $path
     * @param array $query
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    protected function getRequest(string $path, array $query): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * @param string $path
     * @param array $json
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    protected function postRequest(string $path, array $json = []): array
    {
        return $this->request('POST', $path, [], $json);
    }

    /**
     * @param string $path
     * @param array $json
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    protected function optionsRequest(string $path, array $json = []): array
    {
        return $this->request('OPTIONS', $path, [], $json);
    }

    /**
     * @param string $path
     * @param string $body
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    protected function deleteRequest(string $path, string $body): array
    {
        return $this->request('DELETE', $path, [], [], $body);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $query
     * @param array $json
     * @param string|null $body
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    protected function request(string $method, string $path, array $query = [], array $json = [], string $body = null): array
    {
        $options = [
            'http_errors' => true,
            'headers' => [
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
            ],
            'query' => $query,
            'body' => $body
        ];

        if (count($json)) {
            $options['json'] = $json;
        }

        $response = $this->client->request($method, self::BASE_URL . $path, $options);

        // Parse the response
        $data = (string)$response->getBody();

        if (strlen($data) > 0) {
            $data = json_decode($data, true);

            if (!is_array($data)) {
                throw new InvalidResponse("Malformed response data");
            }
        } else {
            $data = [];
        }

        return $data;
    }
}