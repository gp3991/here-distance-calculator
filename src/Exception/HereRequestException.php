<?php

namespace Gp3991\HereDistanceCalculator\Exception;

use Gp3991\HereDistanceCalculator\Here\Client\ClientResponseInterface;

class HereRequestException extends \Exception
{
    public const DEFAULT_ERROR_MESSAGE = 'HERE API error';
    public const DEFAULT_ERROR_CODE = 400;

    public function __construct($message = self::DEFAULT_ERROR_MESSAGE, $code = self::DEFAULT_ERROR_CODE)
    {
        parent::__construct($message, $code);
    }

    public static function fromClientResponse(ClientResponseInterface $response): self
    {
        $content = $response->getContent();

        if (isset($content['error']) && isset($content['error_description'])) {
            return new HereRequestException(
                sprintf(
                    '%s - %s',
                    $content['error'],
                    $content['error_description']
                ),
                $response->getStatusCode()
            );
        }

        return new HereRequestException();
    }
}
