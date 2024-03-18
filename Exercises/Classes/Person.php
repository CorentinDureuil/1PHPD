<?php

namespace Classes;
class Person
{
    public $firstName;
    public $lastName;
    public $age;
    public $size;
    public $zipCode;

    public function __construct($firstName, $lastName, $age, $size, $zipCode)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->size = $size;
        $this->zipCode = $zipCode;
    }

    public function displayInformation()
    {
        echo "$this->firstName $this->lastName. Age: $this->age ans. Taille: $this->size m. Code: $this->zipCode";
    }
}
