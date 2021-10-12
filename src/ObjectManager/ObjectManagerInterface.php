<?php

namespace Gp3991\HereDistanceCalculator\ObjectManager;

use Gp3991\HereDistanceCalculator\Model\DbModelInterface;

interface ObjectManagerInterface
{
    public function save(DbModelInterface $object);

    public function update(DbModelInterface $object);

    public function delete(DbModelInterface $object);
}
