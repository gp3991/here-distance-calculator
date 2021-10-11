<?php

namespace Gp3991\HereDistanceCalculator\Storage;

interface PDOConnectionInterface
{
    public function getConnection(): \PDO;
}
