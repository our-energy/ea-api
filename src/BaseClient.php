<?php

namespace OurEnergy\EMI;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

abstract class BaseClient
{
    const BASE_URL = 'https://emi.azure-api.net';

    /**
     * @var array
     */
    const ALLOWED_STATUS_CODES = [
        200,
        204,
        304 // Trying to subscribe with an existing URL
    ];

    /**
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * @param string $subscriptionKey
     */
    public function __construct(string $subscriptionKey)
    {
        $this->subscriptionKey = $subscriptionKey;

        $this->client = new Client();
    }

    /**
     * @param string $path
     * @param array $query
     * @return array
     */
    protected function getRequest(string $path, array $query) : array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * @param string $path
     * @param array $json
     * @return array
     */
    protected function postRequest(string $path, array $json = []) : array
    {
        return $this->request('POST', $path, [], $json);
    }

    protected function optionsRequest(string $path, array $json = []) : array
    {
        return $this->request('OPTIONS', $path, [], $json);
    }

    protected function deleteRequest(string $path, string $body) : array
    {
        return $this->request('DELETE', $path, [], [], $body);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $query
     * @param array $json
     * @return array
     */
    protected function request(string $method, string $path, array $query = [], array $json = [], string $body = null) : array
    {
        $options = [
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

        $status = $response->getStatusCode();

        if (!in_array($status, self::ALLOWED_STATUS_CODES)) {
            throw new \Exception("Request failed with status code {$status}");
        }

        $data = (string)$response->getBody();

        var_dump($data);

        if (strlen($data)) {
            $data = json_decode($data, true);

            if (!is_array($data)) {
                throw new \Exception("Malformed response data");   
            }
        } else {
            $data = [];
        }

        return $data;
    }
}