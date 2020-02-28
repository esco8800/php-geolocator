<?php
/**
 * Файл класса ChainLocator
 * Использует паттерн цепочка обязанностей
 */

namespace esco8800\phpgeolocator;

class ChainLocator implements LocatorInterface
{
    /**
     * @var array
     */
    private $locators;

    public function __construct(array $locators)
    {
        $this->locators = $locators;
    }

    /**
     * Метод поиска реализущий передачу обязанности локаторам из массива
     *
     * @param Ip $ip
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location
    {
        $result = null;

        foreach ($this->locators as $locator) {
            /** @var Location $location */
            $location = $locator->locate($ip);

            if ($location === null) {
                continue;
            }

            if ($location->getCity() !== null) {
                return $location;
            }

            if ($result === null && $location->getRegion() !== null) {
                $result = $location;
                return $result;
            }

            if ($result === null || $location->getRegion() === null) {
                $result = $location;
            }
        }
        return $result;
    }

}