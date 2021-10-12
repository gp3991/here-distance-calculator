<?php

namespace Gp3991\HereDistanceCalculator\Here\Client;

abstract class AbstractApiClient implements ApiClientInterface
{
    public function request(string $url, array $query = []): ?ClientResponse
    {
        if (count($query)) {
            $url = sprintf(
                '%s?%s',
                $url,
                http_build_query($query)
            );
        }

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        try {
            return $result ?
                new ClientResponse(
                    $httpCode,
                    json_decode($result, true, flags: JSON_THROW_ON_ERROR)
                ) : null;
        } catch (\JsonException) {
            return null;
        }
    }
}
