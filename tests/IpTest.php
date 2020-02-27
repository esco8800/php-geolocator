<?php
/**
 * Файл тестов для Ip
 */

namespace esco8800\phpgeolocator\test;

use esco8800\phpgeolocator\Ip;
use PHPUnit\Framework\TestCase;

class IpTest extends TestCase
{

    public function testIp4(): void
    {
        $ip = new Ip($value = '8.8.8.8');
        self::assertEquals($value, $ip->getValue());
    }

    public function testIp6(): void
    {
        $ip = new Ip($value = '8.8.8.8.8.8');
        self::assertEquals($value, $ip->getValue());
    }

    public function testInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Ip($value = 'invalid');
    }

    public function testEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Ip($value = '');
    }

}