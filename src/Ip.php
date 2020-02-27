<?php
/**
 * Файл класса сущности Ip
 */

namespace esco8800\phpgeolocator;

final class Ip
{
    /**
     * @var string Значение ip-address
     */
    private $value;

    public function __construct(string $ip)
    {
        if (empty($ip)){
            throw new \InvalidArgumentException('Empty IP');
        }

        if (filter_var($ip, FILTER_VALIDATE_IP) === false){
            throw new \InvalidArgumentException('Invalid IP' . $ip);
        }

        $this->value = $ip;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}