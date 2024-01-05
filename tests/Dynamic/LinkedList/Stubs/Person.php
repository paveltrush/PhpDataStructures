<?php

namespace Salazar\Tests\Dynamic\LinkedList\Stubs;

use Salazar\PhpDataStructures\Contracts\DataInterface;

class Person implements DataInterface
{
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $dateOfBirth;
    /**
     * @var bool
     */
    private $gender;

    public function __construct(string $firstName, string $lastName, string $dateOfBirth, bool $gender)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->gender = $gender;
    }

    public function __set($var, $value)
    {
        if ($var === 'gender') {
            $this->gender = $value === 'male' || $value === 'man';
        }
    }

    public function getAge()
    {
        $age = date_diff(new \DateTime('now'), new \DateTime($this->dateOfBirth));

        return $age->y;
    }

    public function getFullName(): string
    {
        return $this->firstName." ".$this->lastName;
    }

    public function display()
    {
        return "Name: $this->firstName $this->lastName\n" .
            "Age: ".$this->getAge()."\n" .
            "Gender: $this->gender\n";
    }

    public function sortingValue()
    {
        return $this->getAge();
    }
}