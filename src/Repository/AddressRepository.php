<?php

namespace Gp3991\HereDistanceCalculator\Repository;

use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;

class AddressRepository implements RepositoryInterface
{
    const TABLE_NAME = 'address';

    public function __construct(
        public PDOConnectionInterface $connection
    ) {
    }

    public function find(mixed $id): ?Address
    {
        $stmt = $this->connection
            ->getConnection()
            ->prepare(
                sprintf(
                    "SELECT * FROM %s WHERE id = :id",
                    self::TABLE_NAME
                )
            );

        $stmt->execute(['id' => $id]);
        $address = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $address ? Address::createFromArray($address) : null;
    }

    /** @return Address[] */
    public function findAll(): array
    {
        $stmt = $this->connection
            ->getConnection()
            ->prepare(
                sprintf(
                    "SELECT * FROM %s",
                    self::TABLE_NAME
                )
            );

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return array_map(
            fn ($item) => Address::createFromArray($item),
            $results
        );
    }
}
