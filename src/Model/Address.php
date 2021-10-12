<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;

class Address implements DbModelInterface, ApiModelInterface
{
    public int $id;
    public string $label;
    public float $lat;
    public float $lon;

    public static function createFromArray(array $data): DbModelInterface
    {
        $obj = new Address();

        $obj->id = (int) $data['id'];
        $obj->label = $data['label'];
        $obj->lat = (float) $data['lat'];
        $obj->lon = (float) $data['lon'];

        return $obj;
    }

    #[ArrayShape(['id' => "int", 'label' => "string", 'lat' => "float", 'lon' => "float"])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
