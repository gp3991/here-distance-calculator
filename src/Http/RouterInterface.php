<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface RouterInterface
{
    public static function get(string $route, callable $callback);

    public static function post(string $route, callable $callback);
}
