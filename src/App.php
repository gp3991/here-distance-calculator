<?php

namespace Gp3991\HereDistanceCalculator;

use Gp3991\HereDistanceCalculator\Controller\HomeController;
use Gp3991\HereDistanceCalculator\Controller\NotFoundController;
use Gp3991\HereDistanceCalculator\Http\ApiRouter;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;

class App
{
    public static function create(): App
    {
        return (new App())->init();
    }

    private function init(): self
    {
        $this->registerRoutes();

        return $this;
    }

    private function registerRoutes()
    {
        ApiRouter::get(
            '/',
            fn (JsonRequestInterface $request) => (new HomeController())->index()
        );

        ApiRouter::get(
            '/404',
            fn (JsonRequestInterface $request) => (new NotFoundController())->index()
        );
    }
}
