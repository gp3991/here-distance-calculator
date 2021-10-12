<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class ValidatorNotFoundException extends \Exception
{
    public const MESSAGE = 'There are no validators supporting the %s type object.';

    public function __construct(string $objectType)
    {
        parent::__construct(
            sprintf(self::MESSAGE, $objectType)
        );
    }
}
