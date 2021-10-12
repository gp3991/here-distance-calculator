<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Assert\AssertionFailedException;
use Gp3991\HereDistanceCalculator\Exception\ValidatorNotFoundException;
use Gp3991\HereDistanceCalculator\Here\Location;
use Gp3991\HereDistanceCalculator\Validator\LocationValidator;
use Gp3991\HereDistanceCalculator\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testShouldThrowExceptionForUnknownObject(): void
    {
        $unknownObject = new \stdClass();

        $this->expectException(ValidatorNotFoundException::class);
        $this->validator->validate($unknownObject);
    }
}
