<?php

namespace updg\roadrunner\easy;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface PSR7IntegrationInterface extends IntegrationInterface
{
    /**
     * Process request received from RoadRunner server
     *
     * @param RequestInterface $request PSR7 Request object
     * @return ResponseInterface PSR7 Response object
     */
    public function processRequest(RequestInterface $request): ResponseInterface;
}
