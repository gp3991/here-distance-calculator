<?php

namespace Gp3991\HereDistanceCalculator\Exception;

interface HttpExceptionInterface
{
    public function getStatusCode(): int;

    public function getContent(): string;
}
