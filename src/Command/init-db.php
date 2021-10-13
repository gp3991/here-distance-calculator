<?php

use Gp3991\HereDistanceCalculator\Storage\Schema;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;

require_once __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->safeLoad();

$dotenv->required(['DB_FILE', 'HERE_API_KEY'])->notEmpty();

$dbFile = __DIR__.'/../../'.$_ENV['DB_FILE'];

$conn = new SQLiteConnection(
    sprintf(
        'sqlite:%s',
        __DIR__.'/../../'.$_ENV['DB_FILE']
    )
);
$pdo = $conn->getConnection();

$schema = new Schema($conn);

$schema->down()->up()->seed();
