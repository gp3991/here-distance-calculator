<?php

namespace Gp3991\HereDistanceCalculator;

use Gp3991\HereDistanceCalculator\Config\SQLiteConfig;
use Gp3991\HereDistanceCalculator\Controller\AddressController;
use Gp3991\HereDistanceCalculator\Controller\HomeController;
use Gp3991\HereDistanceCalculator\Controller\NotFoundController;
use Gp3991\HereDistanceCalculator\Http\ApiRouter;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;
use Gp3991\HereDistanceCalculator\Http\RouterInterface;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;

class App
{
    public function __construct(
        private RouterInterface $router
    ) {
    }

    public static function create(): App
    {
        return (new App(new ApiRouter()))->init();
    }

    public function getDatabaseConnection(): PDOConnectionInterface
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
        
        $this->router->get(
            '/',
            fn (JsonRequestInterface $request) => (new HomeController($this))->index()
        );

        $this->router->get(
            '/404',
            fn (JsonRequestInterface $request) => (new NotFoundController($this))->index()
        );

        // Address related endpoints

        $this->router->get(
            '/address/list',
            fn (JsonRequestInterface $request) => (new AddressController($this))->getCollectionAction()
        );

        $this->router->get(
            '/address/item',
            fn (JsonRequestInterface $request) => (new AddressController($this))->getItemAction($request)
        );
    }
}
