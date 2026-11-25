<?php

namespace App\Calisthenics\Domain\Person;

class Email
{
    public function __construct(private string $value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}