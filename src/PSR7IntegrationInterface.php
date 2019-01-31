<?php

namespace updg\roadrunner\easy;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface PSR7IntegrationInterface extends IntegrationInterface
{
    /**
     * Process request received from RoadRunner server
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function processRequest(RequestInterface $request): ResponseInterface;
}
