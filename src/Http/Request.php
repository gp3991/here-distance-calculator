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
        return stream_get_contents(STDIN);
    }

    public function getQuery(): array
    {
        return $_GET;
    }
}
