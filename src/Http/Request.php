<?php

namespace Gp3991\HereDistanceCalculator\Http;

class Request implements RequestInterface
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody(): string
    {
        return file_get_contents('php://input');
    }

    public function getQuery(): array
    {
        return $_GET;
    }
}
