<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class BadRequestHttpException extends HttpException
{
    const MESSAGE = 'Bad request';
    const CODE = 400;
}