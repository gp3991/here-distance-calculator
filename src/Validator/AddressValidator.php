<?php

namespace Gp3991\HereDistanceCalculator\Validator;

use Assert\Assertion;
use Gp3991\HereDistanceCalculator\Model\Address;

class AddressValidator implements ValidatorInterface
{
    /**
     * @throws \Assert\AssertionFailedException
     */
    public function validate(object $object)
    {
        if (!$object instanceof Address) {
            return;
        }

        Assertion::notEmpty($object->label, 'Field label is required.');
        Assertion::notEmpty($object->lat, 'Field lat (latitude) is required.');
        Assertion::notEmpty($object->lon, 'Field lon (longitude) is required.');
    }

    public function supports(object $object): bool
    {
        return $object instanceof Address;
    }
}
