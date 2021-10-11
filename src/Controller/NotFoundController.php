<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\Exception\NotFoundHttpException;
use Gp3991\HereDistanceCalculator\Http\JsonRequestInterface;
use Gp3991\HereDistanceCalculator\Http\JsonResponse;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;

class NotFoundController extends AbstractController
{
    public function index(JsonRequestInterface $request): ResponseInterface
    {
        throw new NotFoundHttpException();
    }
}
