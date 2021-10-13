<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\ObjectManager\AddressObjectManager;
use Gp3991\HereDistanceCalculator\Repository\AddressRepository;
use Gp3991\HereDistanceCalculator\Storage\Schema;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;
use PHPUnit\Framework\TestCase;

class AddressObjectManagerTest extends TestCase
{
    const TEST_ADDRESS_ID = 1;
    
    private AddressObjectManager $manager;
    private AddressRepository $repository;

    protected function setUp(): void
    {
        $conn = new SQLiteConnection('sqlite::memory:');

        $this->repository = new AddressRepository($conn);

        $this->manager = new AddressObjectManager(
            $conn,
            $this->repository
        );

        (new Schema($conn))->up()->seed();
    }

    public function testCanCreateObject()
    {
        $label = uniqid();
        $lat =  floatVal(rand(-50, 50).'.'.rand(1, 10000));
        $lon =  floatVal(rand(-50, 50).'.'.rand(1, 10000));


        $address = Address::createFromArray([
            'label' => $label,
            'lat' => $lat,
            'lon' => $lon
        ]);

        $address = $this->manager->save($address);
        $this->assertInstanceOf(Address::class, $address);
        $this->assertIsInt($address->id);
        $this->assertGreaterThan(0, $address->id);
        $this->assertEquals($label, $address->label);
        $this->assertEquals($lat, $address->lat);
        $this->assertEquals($lon, $address->lon);
    }
    
    public function testCanEditObject()
    {
        $id = self::TEST_ADDRESS_ID;
        $address = $this->repository->find($id);
        
        $label = uniqid();
        $address->label = $label;
        
        $address = $this->manager->update($address);
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($label, $address->label);
    }

    public function testCanDeleteObject()
    {
        $id = self::TEST_ADDRESS_ID;
        $address = $this->repository->find($id);
        $this->manager->delete($address);
        
        $check = $this->repository->find($id);
        $this->assertNull($check);
    }
}
