<?php

use Gp3991\HereDistanceCalculator\App;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$dotenv->required(['DB_FILE', 'HERE_API_KEY'])->notEmpty();

$app = App::create();
$app->handleRequest();
