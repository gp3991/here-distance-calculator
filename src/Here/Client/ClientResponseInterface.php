<?php

namespace Gp3991\HereDistanceCalculator\Here\Client;

interface ClientResponseInterface
{
    public function getStatusCode(): int;

    public function getContent(): array;
}
