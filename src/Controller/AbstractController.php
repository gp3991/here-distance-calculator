<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\App;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;

abstract class AbstractController
{
    protected PDOConnectionInterface $dbConnection;
    protected App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getDbConnection(): PDOConnectionInterface
    {
        return $this->app->getDatabaseConnection();
    }
}
