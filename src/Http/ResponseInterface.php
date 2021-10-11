<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface ResponseInterface
{
    const JSON_RESPONSE_HEADER = 'Content-Type: application/json; charset=utf-8';
    
    public function getHeaders(): array;

    public function getContent(): string;

    public function getStatusCode(): int;
}