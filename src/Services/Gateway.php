<?php

namespace SaeedVaziry\PayirSDK\Services;

class Gateway extends AbstractGateway
{
    /**
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }
}
