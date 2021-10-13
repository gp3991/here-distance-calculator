<?php

namespace Gp3991\HereDistanceCalculator\Storage;

/**
 * Use this class to generate/drop and seed database tables.
 */
class Schema
{
    public function __construct(
        private PDOConnectionInterface $connection
    ) {
    }

    public function up(): self
    {
        $pdo = $this->connection->getConnection();

        $pdo->exec('
            CREATE TABLE IF NOT EXISTS address
            (
                id    INTEGER PRIMARY KEY AUTOINCREMENT,
                label VARCHAR(255) NOT NULL,
                lat   DECIMAL NOT NULL,
                lon   DECIMAL NOT NULL
            );
        ');

        return $this;
    }

    public function down(): self
    {
        $pdo = $this->connection->getConnection();

        $pdo->exec('DROP TABLE IF EXISTS address');

        return $this;
    }

    public function seed(): self
    {
        $pdo = $this->connection->getConnection();

        $pdo->exec("INSERT INTO address (id, label, lat, lon) VALUES (1, 'Pawia 9, Kraków', 50.066305, 19.945075);");
        $pdo->exec("INSERT INTO address (id, label, lat, lon) VALUES (2, 'Cyfrowa 8, Szczecin', 53.45112, 14.53645);");

        return $this;
    }
}
