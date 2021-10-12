<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;

class MapLocation implements ApiModelInterface
{
    public function __construct(
        public string $label,
        public float $latitude,
        public float $longitude,
    ) {
    }

    #[ArrayShape(['label' => 'string', 'latitude' => 'float', 'longitude' => 'float'])]
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
