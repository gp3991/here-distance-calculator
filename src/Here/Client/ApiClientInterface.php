<?php

namespace Gp3991\HereDistanceCalculator\Here\Client;

interface ApiClientInterface
{
    public function request(string $url, array $query): ?ClientResponseInterface;
}
