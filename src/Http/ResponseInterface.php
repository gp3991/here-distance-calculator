<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface ResponseInterface
{
    public const JSON_RESPONSE_HEADER = 'Content-Type: application/json; charset=utf-8';
    public const HTML_RESPONSE_HEADER = 'Content-Type: text/html; charset=utf-8';

    public function getHeaders(): array;

    public function getContent(): string;

    public function getStatusCode(): int;
}
