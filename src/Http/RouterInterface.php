<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface RouterInterface
{
    public function getRequest(): RequestInterface;

    public function get(string $route, callable $callback);

    public function post(string $route, callable $callback);

    public function patch(string $route, callable $callback);

    public function delete(string $route, callable $callback);
}
