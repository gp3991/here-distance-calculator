<?php

namespace Gp3991\HereDistanceCalculator\Model;

interface DbModelInterface
{
    public static function createFromArray(array $data): self;

    public function updateFromArray(array $data): self;
}
