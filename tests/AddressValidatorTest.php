<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Assert\AssertionFailedException;
use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\Validator\AddressValidator;
use PHPUnit\Framework\TestCase;

class AddressValidatorTest extends TestCase
{
    private AddressValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new AddressValidator();
    }

    public function testCanValidateAddressObject(): void
    {
        $validAddress = Address::createFromArray([
            'label' => 'Valid address',
            'lat' => 52.44236284976271,
            'lon' => 16.886658089121685
        ]);
        $this->validator->validate($validAddress);
        $this->addToAssertionCount(1);

        $invalidAddress = new Address();
        $this->expectException(AssertionFailedException::class);
        $this->validator->validate($invalidAddress);
    }

    public function testSupportsAddress(): void
    {
        self::assertTrue($this->validator->supports(new Address()));
    }
}
