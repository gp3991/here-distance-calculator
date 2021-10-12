<?php

namespace Gp3991\HereDistanceCalculator\Controller;

use Gp3991\HereDistanceCalculator\Http\Response;
use Gp3991\HereDistanceCalculator\Http\ResponseInterface;

class HomeController extends AbstractController
{
    public function indexAction(): ResponseInterface
    {
        return new Response(
            file_get_contents(__DIR__.'/../../template/swagger.html'),
            headers: [ResponseInterface::HTML_RESPONSE_HEADER]
        );
    }
}
