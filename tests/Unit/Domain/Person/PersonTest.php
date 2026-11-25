<?php

namespace App\Calisthenics\Tests\Unit\Domain\Person;

use App\Calisthenics\Domain\Person\Person;
use App\Calisthenics\Domain\Person\Email;
use App\Calisthenics\Domain\Person\FullName;
use App\Calisthenics\Domain\Person\Address;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
        $this->person = new Person(
            new Email('lucas@example.com'),
            new \DateTimeImmutable('2000-04-03'),
            new FullName('Lucas', 'Martins'),
            new Address('Rua de Exemplo', '71B', 'Meu Bairro', 'Minha Cidade', 'Meu estado', 'Brasil')
        );
    }

    public function testFullNameMustBeReturnedAsString()
    {
        self::assertEquals('Lucas Martins', (string) $this->person->fullName());
    }

    public function testEmailMustBeReturnedAsString()
    {
        self::assertEquals('lucas@example.com', (string) $this->person->email());
    }

    public function testBirthDateMustBeReturnedAsDateTimeInterface()
    {
        self::assertInstanceOf(\DateTimeInterface::class, $this->person->birthDate());
    }
}