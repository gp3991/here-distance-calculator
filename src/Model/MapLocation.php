<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;

class MapLocation implements ApiModelInterface
{
    public function __construct(
        public string $label,
        public float $lat,
        public float $lon,
    ) {
    }

    #[ArrayShape(['label' => 'string', 'lat' => 'float', 'lon' => 'float'])]
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
