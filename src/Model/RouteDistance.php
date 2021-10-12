<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;

class RouteDistance implements ApiModelInterface
{
    public function __construct(
        public int $distance
    ) {
    }

    #[ArrayShape(['distance' => 'int'])]
    public function toArray(): array
    {
        return [
            'distance' => $this->distance,
        ];
    }
}
