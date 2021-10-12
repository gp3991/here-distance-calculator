<?php

namespace Gp3991\HereDistanceCalculator\Model;

class RouteDistance implements ApiModelInterface
{
    public function __construct(
        public int $distance
    ) {
    }

    public function toArray(): array
    {
        return [
            'distance' => $this->distance,
        ];
    }
}
