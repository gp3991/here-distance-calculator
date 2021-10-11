<?php

namespace Gp3991\HereDistanceCalculator\Http;

class JsonResponse implements ResponseInterface
{
    public const ADDITIONAL_HEADERS = [
       ResponseInterface::JSON_RESPONSE_HEADER,
    ];

    public function __construct(
        private mixed $data = [],
        private int $statusCode = 200,
        private array $headers = []
    ) {
    }

    public function getHeaders(): array
    {
        return array_merge(self::ADDITIONAL_HEADERS, $this->headers);
    }

    public function getContent(): string
    {
        return json_encode($this->data);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
