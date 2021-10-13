<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\Repository\AddressRepository;
use Gp3991\HereDistanceCalculator\Storage\Schema;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;
use PHPUnit\Framework\TestCase;

class AddressRepositoryTest extends TestCase
{
    const TEST_ADDRESS_ID = 1;
    
    private AddressRepository $repository;

    protected function setUp(): void
    {
        $conn = new SQLiteConnection('sqlite::memory:');

        $this->repository = new AddressRepository($conn);

        (new Schema($conn))->up()->seed();
    }
    
    public function testCanFindById()
    {
        $address = $this->repository->find(self::TEST_ADDRESS_ID);
        $this->assertInstanceOf(Address::class, $address);
    }

    public function testCanFindAll()
    {
        $result = $this->repository->findAll();
        $this->assertIsArray($result);
        $this->assertGreaterThan(0, count($result));
        
        $address = $result[0];
        $this->assertInstanceOf(Address::class, $address);
    }
    
}
