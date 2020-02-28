<?php
/**
 * Файл тестов для ChainLocator
 */

namespace esco8800\phpgeolocator\test;

use esco8800\phpgeolocator\ChainLocator;
use esco8800\phpgeolocator\Ip;
use esco8800\phpgeolocator\Locator;
use esco8800\phpgeolocator\Location;
use PHPUnit\Framework\TestCase;

class ChainLocatorTest extends TestCase
{
    public function testSuccess()
    {
        $locators = [
            $this->mockLocator(null),
            $this->mockLocator($expected = new Location('Expected')),
            $this->mockLocator(null),
            $this->mockLocator(new Location('Other')),
            $this->mockLocator(null),
        ];

        $locator = new ChainLocator($locators);
        $actual = $locator->locate(new Ip('8.8.8.8'));

        self::assertNotNull($actual);
        self::assertEquals($expected, $actual);
    }

    /**
     * @param Location|null $location
     * @return Locator
     */
    private function mockLocator(?Location $location): Locator
    {
        $mock = $this->createMock(Locator::class);
        $mock->method('locate')->willReturn($location);
        return $mock;
    }

}