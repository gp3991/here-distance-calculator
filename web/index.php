<?php

use Gp3991\HereDistanceCalculator\App;
use Gp3991\HereDistanceCalculator\Http\ApiRouter;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$dotenv->required(['DB_FILE', 'HERE_API_KEY'])->notEmpty();

$app = new App(
    new ApiRouter(),
    new SQLiteConnection(
        sprintf(
            'sqlite:%s',
            __DIR__.'/../'.$_ENV['DB_FILE']
        )
    )
);

$app->handleRequest();
