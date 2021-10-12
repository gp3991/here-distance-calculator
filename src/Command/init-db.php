<?php

use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;

require_once __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->safeLoad();

$dotenv->required(['DB_FILE', 'HERE_API_KEY'])->notEmpty();

$dbFile = __DIR__.'/../../'.$_ENV['DB_FILE'];

$conn = new SQLiteConnection(__DIR__.'/../../'.$_ENV['DB_FILE']);
$pdo = $conn->getConnection();

$pdo->exec('DROP TABLE IF EXISTS address');

$pdo->exec('
CREATE TABLE address
(
    id    INTEGER PRIMARY KEY AUTOINCREMENT,
    label VARCHAR(255) NOT NULL,
    lat   DECIMAL NOT NULL,
    lon   DECIMAL NOT NULL
);
');

$pdo->exec("INSERT INTO address (id, label, lat, lon) VALUES (1, 'Pawia 9, Kraków', 50.066305, 19.945075);");
$pdo->exec("INSERT INTO address (id, label, lat, lon) VALUES (2, 'Cyfrowa 8, Szczecin', 53.45112, 14.53645);");
