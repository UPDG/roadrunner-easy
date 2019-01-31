<?php

namespace updg\roadrunner\easy;

interface IntegrationInterface
{
    /**
     * Calls on initialization of worker before starting listen for requests
     */
    public function init();

    /**
     * Calls right before calling processRequest() on each call
     */
    public function beforeRequest();

    /**
     * Calls right after calling processRequest() on each call
     */
    public function afterRequest();

    /**
     * Calls at the termination call from RoadRunner
     */
    public function shutdown();
}
