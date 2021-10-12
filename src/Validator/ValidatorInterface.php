<?php

namespace Gp3991\HereDistanceCalculator\Validator;

interface ValidatorInterface
{
    public function validate(object $object);

    public function supports(object $object): bool;
}
