<?php

namespace Gp3991\HereDistanceCalculator\Http;

abstract class AbstractRouter implements RouterInterface
{
    public function get(string $route, callable $callback)
    {
        if (!$this->checkMethod('GET')) {
            return;
        }

        $this->request($route, $callback);
    }

    public function post(string $route, callable $callback)
    {
        if (!$this->checkMethod('POST')) {
            return;
        }

        $this->request($route, $callback);
    }

    public function patch(string $route, callable $callback)
    {
        if (!$this->checkMethod('PATCH')) {
            return;
        }

        $this->request($route, $callback);
    }

    public function delete(string $route, callable $callback)
    {
        if (!$this->checkMethod('DELETE')) {
            return;
        }

        $this->request($route, $callback);
    }

    private function checkMethod(string $method): bool
    {
        return $method === ($_SERVER['REQUEST_METHOD'] ?? null);
    }

    protected function request(string $route, callable $callback)
    {
        if (strtok($_SERVER['REQUEST_URI'], '?') === $route) {
            $response = $callback($this->getRequest());

            if (!$response instanceof ResponseInterface) {
                throw new \Exception('Controller result must implement ResponseInterface.');
            }

            $this->sendResponse(
                $response->getStatusCode(),
                $response->getHeaders(),
                $response->getContent()
            );
        }
    }

    protected function sendResponse(int $statusCode, array $headers, string $content)
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

    public function getRequest(): RequestInterface
    {
        return new Request();
    }
}
