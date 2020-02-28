<?php
/**
 * Файл класса Locator
 */

namespace esco8800\phpgeolocator;


class Locator implements LocatorInterface
{
    /**
     * @var HttpClient Клиент для http запросов
     */
    private $client;
    /**
     * @var string Ключ для api определения местоположения
     */
    private $apiKey;

    public function __construct(HttpClient $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * Определение местоположения
     *
     * @param Ip $ip
     * @return Location|null
     */
    public function locate(Ip $ip): ?Location
    {
        $url = 'https://api.ipgeolocation.io/ipgeo?' . http_build_query([
                'apiKey' => $this->apiKey,
                'ip' => $ip->getValue()
            ]);

        $response = $this->client->get($url);

        $data = json_decode($response, true);
        $data = array_map(function ($value) {
            return $value !== '-' ? $value : null;
        }, $data);

        if (empty($data['country_name'])) {
            return null;
        }

        return new Location($data['country_name'], $data['state_prov'], $data['city']);
    }

}