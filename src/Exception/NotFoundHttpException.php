<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class NotFoundHttpException extends HttpException
{
    const MESSAGE_NOT_FOUND = 'Page not found';
    const CODE_NOT_FOUND = 404;

    public function __construct(string $message = self::MESSAGE_NOT_FOUND, int $code = self::CODE_NOT_FOUND, array $data = [])
    {
        parent::__construct($message, $code, $data);
    }
}