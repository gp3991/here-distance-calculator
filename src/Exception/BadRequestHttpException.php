<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class BadRequestHttpException extends HttpException
{
    public const MESSAGE = 'Bad request';
    public const CODE = 400;

    public function __construct(
        string $message = self::MESSAGE,
        int $code = self::CODE,
        array $data = []
    ) {
        parent::__construct($message, $code, $data);
    }
}
