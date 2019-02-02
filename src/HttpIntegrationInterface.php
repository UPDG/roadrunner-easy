<?php

namespace updg\roadrunner\easy;

interface HttpIntegrationInterface extends IntegrationInterface
{
    /**
     * Process request received from RoadRunner server
     *
     * @param array  $ctx  Request context. Contains: remoteAddr => string, protocol -> string, method => string,
     *                     uri => string, headers => array, cookies => array, rawQuery => string, parsed => bool,
     *                     uploads => array, attributes => array.
     * @param string $body Body content. If $ctx[parsed] == true it contains JSON.
     * @return array Response array. Format [status => int, body => string, headers => ?array].
     */
    public function processRequest(array $ctx, $body): array;
}
