<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\Http\JsonResponse;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;

class HomeController extends AbstractController
{
    public function index(): ResponseInterface
    {
        return new JsonResponse(['test' => true]);
    }
}
