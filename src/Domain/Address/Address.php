<?php

namespace App\Calisthenics\Domain\Address;

class Address
{
    public function __construct(private string $street, private string $number, private string $province, private string $city, private string $state, private string $country)
    {
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getProvince(): string
    {
        return $this->province;
    }

    public function getCity(): string
    {
        return $this->city;
    }
    
    public function getState(): string
    {
        return $this->state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}