<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;

class Address implements DbModelInterface, ApiModelInterface
{
    private int $id;
    private string $label;
    private float $lat;
    private float $lon;

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

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLat(): float
    {
        return $this->lat;
    }
    
    public function getLon(): float
    {
        return $this->lon;
    }
}
