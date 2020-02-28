<?php
/**
 * Базовый интерфейс локатора
 */

namespace esco8800\phpgeolocator;

interface LocatorInterface
{
    /**
     * @param string $ip
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location;
}