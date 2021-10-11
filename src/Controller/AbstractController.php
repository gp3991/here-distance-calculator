<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\App;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;

abstract class AbstractController
{
    protected PDOConnectionInterface $dbConnection;
    
    public function __construct()
    {
        $this->dbConnection = App::getDatabaseConnection();
    }
}
