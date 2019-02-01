<?php

namespace updg\roadrunner\easy;

interface HttpIntegrationInterface extends IntegrationInterface
{
    /**
     * Process request received from RoadRunner server
     *
     * @param array  $ctx  Request context
     * @param string $body Body content
     * @return array
     */
    public function processRequest(array $ctx, string $body): array;
}
