<?php

namespace Gp3991\HereDistanceCalculator\Validator;

use Assert\Assertion;
use Assert\AssertionFailedException;
use Gp3991\HereDistanceCalculator\Model\Address;

class AddressValidator implements ValidatorInterface
{
    public const WRONG_LATITUDE_MESSAGE = 'Given latitude is not a valid coordinate.';
    public const WRONG_LONGITUDE_MESSAGE = 'Given longitude is not a valid coordinate.';

    /**
     * @throws AssertionFailedException
     */
    public function validate(object $object)
    {
        if (!$object instanceof Address) {
            return;
        }

        Assertion::notEmpty($object->label, 'Field label is required.');
        Assertion::notEmpty($object->lat, 'Field lat (latitude) is required.');
        Assertion::notEmpty($object->lon, 'Field lon (longitude) is required.');

        Assertion::maxLength($object->label, 250, 'Maximum size of label is 250 characters.');

        Assertion::greaterOrEqualThan($object->lat, -90.0, self::WRONG_LATITUDE_MESSAGE);
        Assertion::lessOrEqualThan($object->lat, 90.0, self::WRONG_LATITUDE_MESSAGE);

        Assertion::greaterOrEqualThan($object->lon, -180.0, self::WRONG_LONGITUDE_MESSAGE);
        Assertion::lessOrEqualThan($object->lon, 180.0, self::WRONG_LONGITUDE_MESSAGE);
    }

    public function supports(object $object): bool
    {
        return $object instanceof Address;
    }
}
