<?php

namespace Gp3991\HereDistanceCalculator\Http;

interface JsonRequestInterface extends RequestInterface
{
    public function getJsonBody(): array;
}
