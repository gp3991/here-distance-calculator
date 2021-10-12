<?php

namespace Gp3991\HereDistanceCalculator\Here;

use Gp3991\HereDistanceCalculator\Exception\HereRequestException;
use Gp3991\HereDistanceCalculator\Exception\HereRouteNotFoundException;
use Gp3991\HereDistanceCalculator\Here\Client\HereClient;

class Here
{
    private HereClient $hereClient;

    public function __construct()
    {
        $this->hereClient = new HereClient();
    }

    public function geocodeAddress(string $address)
    {
    }

    /**
     * Returns route length in meters.
     *
     * @throws HereRequestException
     */
    public function measureDistance(
        Location $origin,
        Location $destination,
        $transportMode = TransportModeEnum::CAR
    ): int {
        $apiCall = $this->hereClient->callRoutes(
            (string) $origin,
            (string) $destination,
            $transportMode,
            'summary'
        );

        if (200 !== $apiCall->getStatusCode()) {
            throw HereRequestException::fromClientResponse($apiCall);
        }

        $responseContent = $apiCall->getContent();

        $length = $responseContent['routes'][0]['sections'][0]['summary']['length'] ?? null;

        if (null === $length) {
            throw new HereRouteNotFoundException();
        }

        return (int) $length;
    }
}
