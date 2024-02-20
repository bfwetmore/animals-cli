<?php

namespace src\Animals;

class Cat extends Animal
{
    public function __construct(string $name)
    {
        parent::__construct($name, "meow");
    }
}
