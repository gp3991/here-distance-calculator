<?php

namespace Gp3991\HereDistanceCalculator\Here\Client;

class ClientResponse implements ClientResponseInterface
{
    public function __construct(
        private int $statusCode,
        private array $content,
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): array
    {
        return $this->content;
    }
}
