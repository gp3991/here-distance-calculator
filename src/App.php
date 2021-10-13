<?php

namespace Gp3991\HereDistanceCalculator;

use Gp3991\HereDistanceCalculator\Controller\AddressController;
use Gp3991\HereDistanceCalculator\Controller\HereController;
use Gp3991\HereDistanceCalculator\Controller\HomeController;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;
use Gp3991\HereDistanceCalculator\Http\RouterInterface;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;

class App
{
    public function __construct(
        private RouterInterface $router,
        private PDOConnectionInterface $dbConnection
    ) {
    }

    public function getDatabaseConnection(): PDOConnectionInterface
    {
        return $this->dbConnection;
    }

    public function handleRequest()
    {
        $this->registerRoutes();
        $this->notFound();
    }

    private function registerRoutes()
    {
        $this->router->get(
            '/',
            fn (JsonRequestInterface $request) => (new HomeController($this))->indexAction()
        );

        // Address related endpoints

        $this->router->get(
            '/address/collection',
            fn (JsonRequestInterface $request) => (new AddressController($this))->getCollectionAction()
        );

        $this->router->get(
            '/address/item',
            fn (JsonRequestInterface $request) => (new AddressController($this))->getItemAction($request)
        );

        $this->router->post(
            '/address/item',
            fn (JsonRequestInterface $request) => (new AddressController($this))->createItemAction($request)
        );

        $this->router->patch(
            '/address/item',
            fn (JsonRequestInterface $request) => (new AddressController($this))->updateItemAction($request)
        );

        $this->router->delete(
            '/address/item',
            fn (JsonRequestInterface $request) => (new AddressController($this))->removeItemAction($request)
        );

        // HERE API related endpoints

        $this->router->get(
            '/here/calculate-route',
            fn (JsonRequestInterface $request) => (new HereController($this))->calculateRouteAction($request)
        );

        $this->router->get(
            '/here/geocode',
            fn (JsonRequestInterface $request) => (new HereController($this))->geocodeAddressAction($request)
        );
    }

    private function notFound()
    {
        http_response_code(404);
        exit;
    }
}
