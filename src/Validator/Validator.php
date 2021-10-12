<?php

namespace Gp3991\HereDistanceCalculator\Validator;

use Gp3991\HereDistanceCalculator\Exception\ValidatorNotFoundException;

class Validator
{
    private array $validators;

    public function __construct()
    {
        $this->validators = [
            new AddressValidator(),
            new LocationValidator(),
        ];
    }

    /**
     * @throws ValidatorNotFoundException
     */
    public function validate(object $object)
    {
        $validator = $this->getValidator($object);

        if (null === $validator) {
            throw new ValidatorNotFoundException(get_class($object));
        }

        $validator->validate($object);
    }

    private function getValidator(object $object): ?ValidatorInterface
    {
        foreach ($this->validators as $validator) {
            if ($validator->supports($object)) {
                return $validator;
            }
        }

        return null;
    }
}
