<?php

namespace Gp3991\HereDistanceCalculator\Exception;

abstract class HttpException extends \Exception implements HttpExceptionInterface
{
    public function __construct(
        string $message,
        int $code,
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
            'message' => $this->message
        ];
        
        if (!empty($this->data)) {
            $content['data'] = $this->data;
        }

        return json_encode($content);
    }
}
