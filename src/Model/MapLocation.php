<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="MapLocation",
 *     description="Map location",
 *     properties={
 *          @OA\Property(
 *              property="label",
 *              format="string",
 *              description="Location label",
 *              example="606-3727 Ullamcorper. Street Roseville NH 11523"
 *          ),
 *          @OA\Property(
 *              property="latitude",
 *              format="number",
 *              description="Latitude",
 *              example="52.44329602318273"
 *          ),
 *          @OA\Property(
 *              property="longitude",
 *              format="number",
 *              description="Longitude",
 *              example="16.86055499415471"
 *          )
 *     }
 * )
 */
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
