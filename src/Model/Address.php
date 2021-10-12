<?php

namespace Gp3991\HereDistanceCalculator\Model;

use JetBrains\PhpStorm\ArrayShape;

class Address implements DbModelInterface, ApiModelInterface
{
    public const TABLE_NAME = 'address';

    public int $id;
    public ?string $label = null;
    public ?float $lat = null;
    public ?float $lon = null;

    private function assignArrayData(array $data): self
    {
        foreach ($data as $key => $value) {
            if (!property_exists($this, $key)) {
                continue;
            }

            $this->{$key} = match ($key) {
                'id' => (int) $value,
                'label' => $value,
                'lat', 'lon' => (float) $value
            };
        }

        return $this;
    }

    public static function createFromArray(array $data): DbModelInterface
    {
        return (new Address())->assignArrayData($data);
    }

    public function updateFromArray(array $data): DbModelInterface
    {
        // Prevent id field update
        unset($data['id']);
        return $this->assignArrayData($data);
    }

    #[ArrayShape(['id' => 'int', 'label' => 'string', 'lat' => 'float', 'lon' => 'float'])]
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
