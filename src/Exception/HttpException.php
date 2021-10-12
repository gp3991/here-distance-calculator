<?php

namespace Gp3991\HereDistanceCalculator\Exception;

abstract class HttpException extends \Exception implements HttpExceptionInterface
{
    public const MESSAGE = '';
    public const CODE = 0;

    public function __construct(
        string $message = self::MESSAGE,
        int $code = self::CODE,
        private array $data = []
    ) {
        parent::__construct($message, $code);
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getContent(): string
    {
        $content = [
            'error' => true,
            'code' => $this->code,
            'message' => $this->message,
        ];

        if (!empty($this->data)) {
            $content['data'] = $this->data;
        }

        return json_encode($content);
    }
}
