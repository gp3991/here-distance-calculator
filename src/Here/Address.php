<?php

namespace Gp3991\HereDistanceCalculator\Here;

class Address
{
    public Location $location;

    public function __construct(
        public string $label,
        float $latitude,
        float $longitude,
    ) {
        $this->location = new Location($latitude, $longitude);
    }
}
