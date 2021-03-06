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
        $this->hereClient = new HereClient($_ENV['HERE_API_KEY']);
    }

    /**
     * @throws HereRequestException
     *
     * @return Address[]
     */
    public function geocodeAddress(string $query): array
    {
        $apiCall = $this->hereClient->callGeocoder($query);

        if (200 !== $apiCall->getStatusCode()) {
            throw HereRequestException::fromClientResponse($apiCall);
        }

        $items = $apiCall->getContent()['items'] ?? [];
        $result = [];

        foreach ($items as $item) {
            $result[] = new Address(
                $item['title'] ?? '',
                $item['position']['lat'] ?? 0,
                $item['position']['lng'] ?? 0,
            );
        }

        return $result;
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
