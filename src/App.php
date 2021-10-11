<?php

namespace Gp3991\HereDistanceCalculator;

use Gp3991\HereDistanceCalculator\Config\SQLiteConfig;
use Gp3991\HereDistanceCalculator\Controller\AddressController;
use Gp3991\HereDistanceCalculator\Controller\HomeController;
use Gp3991\HereDistanceCalculator\Controller\NotFoundController;
use Gp3991\HereDistanceCalculator\Http\ApiRouter;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;

class App
{
    public static function create(): App
    {
        return (new App())->init();
    }

    public static function getDatabaseConnection(): PDOConnectionInterface
    {
        return new SQLiteConnection(__DIR__ . '/../' . SQLiteConfig::DB_FILE);
    }
    
    private function init(): self
    {
        $this->registerRoutes();
        return $this;
    }

    private function registerRoutes()
    {
        // Other/dummy endpoints
        
        ApiRouter::get(
            '/',
            fn (JsonRequestInterface $request) => (new HomeController())->index()
        );

        ApiRouter::get(
            '/404',
            fn (JsonRequestInterface $request) => (new NotFoundController())->index()
        );

        // Address related endpoints
        
        ApiRouter::get(
            '/address/list',
            fn (JsonRequestInterface $request) => (new AddressController())->getCollectionAction()
        );

        ApiRouter::get(
            '/address/item',
            fn (JsonRequestInterface $request) => (new AddressController())->getItemAction($request)
        );
    }
}
