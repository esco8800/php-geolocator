<?php
/**
 * Файл класса HttpClient
 */

namespace esco8800\phpgeolocator;

use http\Exception\RuntimeException;

class HttpClient
{
    /**
     * Отрпавка гет запроса по url
     *
     * @param string $url
     * @return string|null
     */
    public function get(string $url): ?string
    {
        $response = @file_get_contents($url);

        if ($response === false) {
            throw new RuntimeException(error_get_last());
        }

        return $response;
    }

}