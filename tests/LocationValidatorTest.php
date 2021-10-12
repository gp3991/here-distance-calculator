<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Assert\AssertionFailedException;
use Gp3991\HereDistanceCalculator\Here\Location;
use Gp3991\HereDistanceCalculator\Validator\LocationValidator;
use PHPUnit\Framework\TestCase;

class LocationValidatorTest extends TestCase
{
    private LocationValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new LocationValidator();
    }

    public function testCanValidateLocationObject(): void
    {
        $validLocation = new Location(52.44236284976271, 16.886658089121685);
        $this->validator->validate($validLocation);
        $this->addToAssertionCount(1);

        $invalidLocation = new Location(522.44236284976271, 1612.886658089121685);
        $this->expectException(AssertionFailedException::class);
        $this->validator->validate($invalidLocation);
    }

    public function testSupportsLocation(): void
    {
        self::assertTrue($this->validator->supports((new Location(52.44236284976271, 16.8866580))));
    }
}
