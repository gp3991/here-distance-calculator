<?php

namespace Gp3991\HereDistanceCalculator\Exception;

class HereRouteNotFoundException extends HereRequestException
{
    public const MESSAGE = 'The given route has not been found';
    public const CODE = 404;

    public function __construct($message = self::MESSAGE, $code = self::CODE)
    {
        parent::__construct($message, $code);
    }
}
