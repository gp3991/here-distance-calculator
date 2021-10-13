<?php

namespace Gp3991\HereDistanceCalculator\Here\Client;

use Gp3991\HereDistanceCalculator\Exception\HereRequestException;

class HereClient extends AbstractApiClient
{
    public const ROUTES_ENDPOINT_URL = 'https://router.hereapi.com/v8/routes';
    public const GEOCODE_ENDPOINT_URL = 'https://autosuggest.search.hereapi.com/v1/geocode';

    public function __construct(
        private string $apiKey
    ) {
    }

    public function request(string $url, array $query = []): ?ClientResponse
    {
        $query['apiKey'] = $this->apiKey;

        return parent::request($url, $query);
    }

    /**
     * @throws HereRequestException
     */
    public function callRoutes(
        string $origin,
        string $destination,
        string $transportMode,
        string $return
    ): ClientResponse {
        $data = [
            'transportMode' => $transportMode,
            'origin' => $origin,
            'destination' => $destination,
            'return' => $return,
        ];

        $result = $this->request(self::ROUTES_ENDPOINT_URL, $data);

        if (null === $result) {
            throw new HereRequestException('HERE API returned empty response');
        }

        return $result;
    }

    /**
     * @throws HereRequestException
     */
    public function callGeocoder(string $query): ClientResponse
    {
        $data = [
            'q' => $query,
        ];

        $result = $this->request(self::GEOCODE_ENDPOINT_URL, $data);

        if (null === $result) {
            throw new HereRequestException('HERE API returned empty response');
        }

        return $result;
    }
}
