<?php

namespace Gp3991\HereDistanceCalculator\Storage\SQLite;

use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;

class SQLiteConnection implements PDOConnectionInterface
{
    private ?\PDO $pdo = null;
    
    public function __construct(
        private string $dbFile
    ) {
    }
    
    private function connect()
    {
        $this->pdo = new \PDO("sqlite:" . $this->dbFile);
    }
    
    public function getConnection(): \PDO
    {
        if (null === $this->pdo) {
            $this->connect();
        }
        
        return $this->pdo;
    }
}
