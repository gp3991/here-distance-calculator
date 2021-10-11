<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface ResponseInterface
{
    public function getHeaders(): array;

    public function getContent(): string;
}
