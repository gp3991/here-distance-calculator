<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Dotenv\Dotenv;
use Gp3991\HereDistanceCalculator\Here\Client\ClientResponse;
use Gp3991\HereDistanceCalculator\Here\Client\HereClient;
use Gp3991\HereDistanceCalculator\Here\TransportModeEnum;
use PHPUnit\Framework\TestCase;

class HereClientTest extends TestCase
{
    private HereClient $hereClient;

    protected function setUp(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->safeLoad();

        $this->hereClient = new HereClient($_ENV['HERE_API_KEY']);
    }

    public function testRoutes()
    {
        $result = $this->hereClient->callRoutes(
            '52.441750708207486, 16.886383634612844',
            '52.4468175548471, 16.889074964165122',
            TransportModeEnum::CAR,
            'summary'
        );

        $this->assertInstanceOf(ClientResponse::class, $result);

        $responseContent = $result->getContent();
        $this->assertIsArray($responseContent);
        $this->assertArrayHasKey('routes', $responseContent);

        $length = (int) $responseContent['routes'][0]['sections'][0]['summary']['length'] ?? null;
        $this->assertGreaterThan(0, $length);
    }

    public function testGeocoder()
    {
        $result = $this->hereClient->callGeocoder(
            'Garbary 53, Poznań'
        );

        $this->assertInstanceOf(ClientResponse::class, $result);

        $responseContent = $result->getContent();
        $this->assertIsArray($responseContent);
        $this->assertArrayHasKey('items', $responseContent);

        $items = $responseContent['items'];

        $this->assertIsArray($items);
        $this->assertGreaterThan(0, count($items));

        $firstItem = $items[0];

        $this->assertIsArray($firstItem);
        $this->assertArrayHasKey('title', $firstItem);
        $this->assertArrayHasKey('position', $firstItem);

        $position = $firstItem['position'];
        $this->assertIsArray($position);
        $this->assertArrayHasKey('lat', $position);
        $this->assertArrayHasKey('lng', $position);
    }

}
