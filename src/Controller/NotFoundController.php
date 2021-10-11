<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\Exception\HttpException;
use Gp3991\HereDistanceCalculator\Exception\NotFoundHttpException;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;

class NotFoundController extends AbstractController
{
    /**
     * @throws HttpException
     */
    public function index(): ResponseInterface
    {
        throw new NotFoundHttpException();
    }
}
