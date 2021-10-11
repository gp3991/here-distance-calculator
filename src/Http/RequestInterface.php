<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface RequestInterface
{
    public function getMethod(): string;

    public function getBody(): string;

    public function getQuery(): array;
}
