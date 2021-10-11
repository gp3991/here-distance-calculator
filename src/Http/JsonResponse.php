<?php

namespace Gp3991\HereDistanceCalculator\Http;

class JsonResponse implements ResponseInterface
{
    public function __construct(
        private array $data = [],
        private array $headers = []
    ) {
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getContent(): string
    {
        return json_encode($this->data);
    }
}
