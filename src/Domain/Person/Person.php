<?php

namespace App\Calisthenics\Domain\Person;

use DateTimeInterface;

class Person
{
    public function __construct(private Email $email, private DateTimeInterface $birthDate, private FullName $fullName, private Address $address)
    {
    }

    public function fullName(): string
    {
        return (string) $this->fullName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function birthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        $today = new \DateTimeImmutable();
        $dateInterval = $this->birthDate->diff($today);
        return $dateInterval->y;
    }
}