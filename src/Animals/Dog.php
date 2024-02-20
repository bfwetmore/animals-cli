<?php

namespace src\Animals;

class Dog extends Animal
{
    public function __construct(string $name)
    {
        parent::__construct($name, "woof");
    }
}
