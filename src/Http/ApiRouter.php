<?php

namespace Gp3991\HereDistanceCalculator\Http;

use Assert\AssertionFailedException;
use Gp3991\HereDistanceCalculator\Exception\BadRequestHttpException;
use Gp3991\HereDistanceCalculator\Exception\HttpExceptionInterface;

class ApiRouter extends AbstractRouter
{
    protected function request(string $route, callable $callback)
    {
        if (strtok($_SERVER['REQUEST_URI'], '?') === $route) {
            try {
                parent::request($route, $callback);
            } catch (AssertionFailedException $e) {
                $httpException = new BadRequestHttpException($e->getMessage());
                $this->returnHttpException($httpException);
            } catch (HttpExceptionInterface $e) {
                $this->returnHttpException($e);

                return;
            }
        }
    }

    private function returnHttpException(HttpExceptionInterface $exception)
    {
        $this->sendResponse(
            $exception->getStatusCode(),
            [ResponseInterface::JSON_RESPONSE_HEADER],
            $exception->getContent()
        );
    }

    public function getRequest(): RequestInterface
    {
        return new JsonRequest();
    }
}
