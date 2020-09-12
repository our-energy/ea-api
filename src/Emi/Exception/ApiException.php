<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Exception;

use Psr\Http\Client\ClientExceptionInterface;
use \Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends Exception implements ClientExceptionInterface
{
    protected $request;

    protected $response;

    public function __construct($message, $code, RequestInterface $request, ResponseInterface $response)
    {
        parent::__construct($message, $code);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
