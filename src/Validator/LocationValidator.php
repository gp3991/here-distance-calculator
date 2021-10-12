<?php

namespace Gp3991\HereDistanceCalculator\Validator;

use Assert\Assertion;
use Gp3991\HereDistanceCalculator\Here\Location;

class LocationValidator implements ValidatorInterface
{
    public const WRONG_LATITUDE_MESSAGE = 'Given latitude is not a valid coordinate.';
    public const WRONG_LONGITUDE_MESSAGE = 'Given longitude is not a valid coordinate.';

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function validate(object $object)
    {
        if (!$object instanceof Location) {
            return;
        }

        Assertion::greaterOrEqualThan($object->latitude, -90.0, self::WRONG_LATITUDE_MESSAGE);
        Assertion::lessOrEqualThan($object->latitude, 90.0, self::WRONG_LATITUDE_MESSAGE);

        Assertion::greaterOrEqualThan($object->longitude, -180.0, self::WRONG_LONGITUDE_MESSAGE);
        Assertion::lessOrEqualThan($object->longitude, 180.0, self::WRONG_LONGITUDE_MESSAGE);
    }

    public function supports(object $object): bool
    {
        return $object instanceof Location;
    }
}
