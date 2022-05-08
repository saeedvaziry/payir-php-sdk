<?php

namespace SaeedVaziry\PayirSDK\DTO\Gateway;

use SaeedVaziry\PayirSDK\DTO\DTOInterface;

class SendDTO implements DTOInterface
{
    /**
     * @var string
     */
    public $token;

    /**
     * @param array $body
     * @return $this
     */
    public static function fromArray(array $body): self
    {
        $dto = new self();
        $dto->token = $body['token'];

        return $dto;
    }
}
