<?php

namespace updg\roadrunner\easy;

use Spiral\Goridge\RelayInterface;
use Spiral\RoadRunner\HttpClient;
use Spiral\RoadRunner\PSR7Client;
use updg\roadrunner\easy\Exceptions\InvalidClientException;

class RoadRunner
{
    /** @var IntegrationInterface */
    private $_integration;

    /** @var RelayInterface */
    private $_relay;

    /** @var bool State of client */
    private $_running = false;

    /** @var string Class of client object */
    private $_clientType;

    /**
     * Easy constructor.
     *
     * @param IntegrationInterface $integration Integration object.
     * @param RelayInterface|null  $relay       Replay object. By default StreamRelay used.
     * @throws InvalidClientException
     */
    public function __construct(IntegrationInterface $integration, $relay = null)
    {
        if ($relay && $relay instanceof RelayInterface) {
            $this->_relay = $relay;
        } else {
            $this->_relay = new \Spiral\Goridge\StreamRelay(STDIN, STDOUT);
        }

        switch (true) {
            case $integration instanceof HttpIntegrationInterface:
                $this->_clientType = HttpClient::class;
                break;
            case $integration instanceof PSR7IntegrationInterface:
                $this->_clientType = PSR7Client::class;
                break;
            default:
                throw new InvalidClientException('Integration must implement HttpIntegrationInterface or PSR7IntegrationInterface.');
        }

        $this->_integration = $integration;
    }

    public function run()
    {
        if ($this->_running)
            return;

        $this->_integration->init();

        $this->startListen();
    }

    private function startListen()
    {
        $clientType = $this->_clientType;

        /** @var PSR7Client $client */
        $client = new $clientType(new \Spiral\RoadRunner\Worker($this->_relay));

        while ($req = $client->acceptRequest()) {

            if($req === null) {
                $this->_integration->shutdown();
                return;
            }

            $this->_integration->beforeRequest();

            switch ($this->_clientType) {
                case HttpClient::class:
                    $response = $this->_integration->processRequest($req['ctx'], $req['body']);
                    break;
                case PSR7Client::class:
                    $response = $this->_integration->processRequest($req);
                    break;
            }

            $this->_integration->afterRequest();

            switch ($this->_clientType) {
                case HttpClient::class:
                    /** @var HttpClient $client */
                    $client->respond($response['status'], $response['body'], $response['headers'] ?? []);
                    break;
                case PSR7Client::class:
                    /** @var PSR7Client $client */
                    $client->respond($response);
                    break;
            }
        }
    }
}
