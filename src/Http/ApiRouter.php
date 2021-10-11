<?php

namespace Gp3991\HereDistanceCalculator\Http;

class ApiRouter implements RouterInterface
{
    public static function get(string $route, callable $callback)
    {
        if ('GET' !== $_SERVER['REQUEST_METHOD']) {
            return;
        }

        self::request($route, $callback);
    }

    public static function post(string $route, callable $callback)
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return;
        }

        self::request($route, $callback);
    }

    /**
     * @throws \Exception
     */
    private static function request(string $route, callable $callback)
    {
        if (strtok($_SERVER['REQUEST_URI'], '?') === $route) {
            $callbackResult = $callback(new JsonRequest());

            if (!$callbackResult instanceof ResponseInterface) {
                throw new \Exception('Controller result must implement ResponseInterface.');
            }
        }
    }
}
