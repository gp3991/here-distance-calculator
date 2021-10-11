<?php

namespace Gp3991\HereDistanceCalculator\Http;

use Gp3991\HereDistanceCalculator\Exception\HttpExceptionInterface;

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

    private static function request(string $route, callable $callback)
    {
        if (strtok($_SERVER['REQUEST_URI'], '?') === $route) {
            
            try {
                $response = $callback(new JsonRequest());
            } catch (HttpExceptionInterface $e) {
                self::sendResponse(
                    $e->getStatusCode(),
                    [ResponseInterface::JSON_RESPONSE_HEADER],
                    $e->getContent()
                );
                
                return;
            }
            
            if (!$response instanceof ResponseInterface) {
                throw new \Exception('Controller result must implement ResponseInterface.');
            }

            self::sendResponse(
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getContent()
            );
        }
    }
    
    private static function sendResponse(int $statusCode, array $headers, string $content)
    {
        // Send response code
        http_response_code($statusCode);
        
        // Send headers
        foreach ($headers as $header) {
            header($header);
        }
        
        // Send content
        echo $content;
        
        exit;
    }
}
