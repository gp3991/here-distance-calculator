<?php

namespace Gp3991\HereDistanceCalculator\Model;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RouteDistance",
 *     description="Route distance",
 *     properties={
 *          @OA\Property(
 *              property="distance",
 *              format="int64",
 *              description="Distance between two points in meters",
 *              example="1234"
 *          )
 *     }
 * )
 */
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
