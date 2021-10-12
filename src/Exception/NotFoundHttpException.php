<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class NotFoundHttpException extends HttpException
{
    public const MESSAGE = 'Page not found';
    public const CODE = 404;

    public function __construct(
        string $message = self::MESSAGE,
        int $code = self::CODE,
        array $data = []
    ) {
        parent::__construct($message, $code, $data);
    }
}
