<?php

namespace Gp3991\HereDistanceCalculator\ObjectManager;

use Gp3991\HereDistanceCalculator\Model\Address;
use Gp3991\HereDistanceCalculator\Model\DbModelInterface;
use Gp3991\HereDistanceCalculator\Repository\AddressRepository;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;

class AddressObjectManager implements ObjectManagerInterface
{
    public function __construct(
        public PDOConnectionInterface $connection,
        private AddressRepository $addressRepository
    ) {
    }

    public function save(DbModelInterface $object): ?Address
    {
        $pdo = $this->connection->getConnection();

        $stmt = $pdo->prepare(
            sprintf(
                'INSERT INTO %s (label, lat, lon) VALUES (:label, :lat, :lon)',
                Address::TABLE_NAME
            )
        );

        $stmt->execute([
            'label' => $object->label,
            'lat' => $object->lat,
            'lon' => $object->lon,
        ]);

        $id = $pdo->lastInsertId();

        return $this->addressRepository->find($id);
    }

    public function update(DbModelInterface $object): Address
    {
        $pdo = $this->connection->getConnection();

        $stmt = $pdo->prepare(
            sprintf(
                'UPDATE %s SET label=:label, lat=:lat, lon=:lon WHERE id=:id',
                Address::TABLE_NAME
            )
        );

        $stmt->execute([
            'id' => $object->id,
            'label' => $object->label,
            'lat' => $object->lat,
            'lon' => $object->lon,
        ]);

        return $this->addressRepository->find($object->id);
    }

    public function delete(DbModelInterface $object)
    {
        $pdo = $this->connection->getConnection();
        $pdo->prepare(
            sprintf(
                'DELETE FROM %s WHERE id=?',
                Address::TABLE_NAME
            )
        )->execute([$object->id]);
    }
}
