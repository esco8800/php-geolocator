<?php
/**
 * Файл тестов для Locator
 */

namespace esco8800\phpgeolocator\test;

use esco8800\phpgeolocator\HttpClient;
use esco8800\phpgeolocator\Ip;
use esco8800\phpgeolocator\Locator;
use PHPUnit\Framework\TestCase;

class LocatorTest extends TestCase
{
    public function testSuccess(): void
    {
        $client = $this->createMock(HttpClient::class);
        $client->method('get')->willReturn('{"country_name":"United States","state_prov":"California","city":"Mountain View"}');

        $locator = new Locator($client, 'key');
        $location = $locator->locate(new Ip('8.8.8.8'));

        self::assertNotNull($location);
        self::assertEquals('United States', $location->getCountry());
        self::assertEquals('California', $location->getRegion());
        self::assertEquals('Mountain View', $location->getCity());
    }

    public function testNotFound(): void
    {
        $client = $this->createMock(HttpClient::class);
        $client->method('get')->willReturn('{"country_name":"-","state_prov":"-","city":"-"}');

        $locator = new Locator($client, 'key');
        $location = $locator->locate(new Ip('0.0.0.1'));

        self::assertNull($location);
    }

}