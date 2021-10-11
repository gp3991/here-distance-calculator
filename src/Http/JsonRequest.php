<?php

namespace Gp3991\HereDistanceCalculator\Http;

class JsonRequest extends Request implements JsonRequestInterface
{
    public function getJsonBody(): array
    {
        try {
            return json_decode($this->getBody(), true, flags: JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return [];
        }
    }
}
