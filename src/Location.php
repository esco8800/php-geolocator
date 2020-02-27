<?php
/**
 * Файл класса Location
 */

namespace esco8800\phpgeolocator;

class Location
{
    /**
     * @var string Страна
     */
    private $country;
    /**
     * @var string|null Регион
     */
    private $region;
    /**
     * @var string|null Город
     */
    private $city;

    public function __construct(
        string $country,
        ?string $region,
        ?string $city
    ) {
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

}