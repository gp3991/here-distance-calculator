<?php

namespace Gp3991\HereDistanceCalculator\Tests;

use Gp3991\HereDistanceCalculator\App;
use Gp3991\HereDistanceCalculator\Http\ApiRouter;
use Gp3991\HereDistanceCalculator\Storage\PDOConnectionInterface;
use Gp3991\HereDistanceCalculator\Storage\SQLite\SQLiteConnection;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    private App $app;

    protected function setUp(): void
    {
        $this->app = new App(
            new ApiRouter(),
            new SQLiteConnection('sqlite::memory:')
        );
    }

    public function testCanProvideDatabaseConnection(): void
    {
        $conn = $this->app->getDatabaseConnection();
        $this->assertInstanceOf(PDOConnectionInterface::class, $conn);

        $pdo = $conn->getConnection();
        $this->assertInstanceOf(\PDO::class, $pdo);
    }
}
