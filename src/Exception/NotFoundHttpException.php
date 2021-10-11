<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class NotFoundHttpException extends HttpException
{
    const MESSAGE = 'Page not found';
    const CODE = 404;
}