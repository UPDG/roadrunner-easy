<?php

namespace updg\roadrunner\easy;

interface HttpIntegrationInterface extends IntegrationInterface
{
    /**
     * Process request received from RoadRunner server
     *
     * @param array $request
     * @return array
     */
    public function processRequest(array $request): array;
}
