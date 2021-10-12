<?php

namespace Gp3991\HereDistanceCalculator\Repository;

interface RepositoryInterface
{
    public function find(int $id): ?object;

    public function findAll(): array;
}
