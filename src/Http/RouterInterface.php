<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface RouterInterface
{
    public function get(string $route, callable $callback);

    public function post(string $route, callable $callback);
}
