<?php

namespace Gp3991\HereDistanceCalculator\Here;

class Location
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {
    }

    public function __toString(): string
    {
        return sprintf('%s,%s', $this->latitude, $this->longitude);
    }
}
